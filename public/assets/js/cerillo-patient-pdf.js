(()=>{'use strict';
// Client-side, downloadable PDF. No print dialog or third-party network needed.
const clean=s=>String(s??'').normalize('NFKD').replace(/[\u0300-\u036f]/g,'').replace(/[^\x20-\x7e]/g,c=>({'₱':'PHP ','–':'-','—':'-','•':'-','→':'->'}[c]||' ')).replace(/\s+/g,' ').trim();
const esc=s=>s.replace(/\\/g,'\\\\').replace(/\(/g,'\\(').replace(/\)/g,'\\)');
function linesFor(text,width=99){const words=clean(text).split(/\s+/);let line='',out=[];for(const word of words){if((line+' '+word).length>width){if(line)out.push(line);line=word;}else line=line?line+' '+word:word;}if(line)out.push(line);return out.length?out:['-'];}
function makePdf(title,entries,filename){
 const rows=[];
 for(const block of entries){
   if(block.head)rows.push({kind:'section',text:clean(block.head)});
   for(const line of (block.lines||[]))for(const wrapped of linesFor(line,92))rows.push({kind:'row',text:wrapped});
 }
 const objects=[null];const add=x=>(objects.push(x),objects.length-1);
 const regular=add('<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>');
 const bold=add('<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>');
 const pages=add(''),pageIds=[];let commands='',y=0,number=0,alternation=0;
 const txt=(str,x,yy,size=10,heavy=false,color='0.16 0.23 0.36')=>`${color} rg BT /${heavy?'B':'R'} ${size} Tf 1 0 0 1 ${x} ${yy} Tm (${esc(clean(str))}) Tj ET\n`;
 const rectangle=(x,yy,w,h,color)=>`${color} rg ${x} ${yy} ${w} ${h} re f\n`;
 const startPage=()=>{number++;commands=rectangle(0,0,595,842,'1 1 1')+rectangle(0,766,595,76,'0.10 0.20 0.42')+rectangle(42,761,511,4,'0.26 0.46 0.94')+txt('CERILLO DENTAL CLINIC',43,807,16,true,'1 1 1')+txt('CLINICAL RECORDS  /  OFFICIAL DOCUMENT',43,787,8,false,'0.82 0.88 1');y=725;commands+=txt(title,43,y,17,true);y-=26;commands+=txt('Generated '+new Date().toLocaleString(),43,y,9,false,'0.38 0.45 0.57');y-=28;alternation=0;};
 const finish=()=>{commands+=rectangle(42,45,511,1,'0.82 0.86 0.92')+txt('Cerillo Dental Clinic  |  Confidential clinic information',43,30,8,false,'0.43 0.48 0.57')+txt('Page '+number,510,30,8,false,'0.43 0.48 0.57');const bytes=new TextEncoder().encode(commands);let stream='';for(const c of bytes)stream+=String.fromCharCode(c);const sid=add(`<< /Length ${bytes.length} >>\nstream\n${stream}\nendstream`);pageIds.push(add(`<< /Type /Page /Parent ${pages} 0 R /MediaBox [0 0 595 842] /Resources << /Font << /R ${regular} 0 R /B ${bold} 0 R >> >> /Contents ${sid} 0 R >>`));};
 startPage();
 for(const r of rows){const height=r.kind==='section'?39:18;if(y-height<68){finish();startPage();}
 if(r.kind==='section'){y-=12;commands+=rectangle(42,y-22,511,27,'0.92 0.95 1')+txt(r.text.toUpperCase(),52,y-13,10,true,'0.12 0.26 0.55');y-=34;alternation=0;}
 else{if(alternation++%2===1)commands+=rectangle(42,y-9,511,18,'0.97 0.98 1');commands+=txt(r.text,52,y,9,false);y-=18;}
 }
 finish();objects[pages]=`<< /Type /Pages /Count ${pageIds.length} /Kids [${pageIds.map(i=>i+' 0 R').join(' ')}] >>`;const root=add(`<< /Type /Catalog /Pages ${pages} 0 R >>`);
 // All PDF instructions are ASCII, so byte offsets are stable.
 let doc='%PDF-1.4\n',offset=[0];objects.forEach((obj,i)=>{if(!i)return;offset[i]=doc.length;doc+=`${i} 0 obj\n${obj}\nendobj\n`;});const ref=doc.length;doc+=`xref\n0 ${objects.length}\n0000000000 65535 f \n`;for(let i=1;i<objects.length;i++)doc+=`${String(offset[i]).padStart(10,'0')} 00000 n \n`;doc+=`trailer\n<< /Size ${objects.length} /Root ${root} 0 R >>\nstartxref\n${ref}\n%%EOF`;
 const blob=new Blob([new Uint8Array(Array.from(doc,c=>c.charCodeAt(0)))],{type:'application/pdf'});const url=URL.createObjectURL(blob),a=document.createElement('a');a.href=url;a.download=filename.replace(/[^a-z0-9._-]/gi,'_');document.body.appendChild(a);a.click();setTimeout(()=>{URL.revokeObjectURL(url);a.remove();},2500);
}
function patientData(dialog){const fields=[];const seen=new Set();const labels={summary:'Patient Overview',visits:'Visit History',medical:'Medical Record',chart:'Dental Chart',pxray:'X-rays',ledger:'Billing Ledger'};
 const sections=[...dialog.querySelectorAll('.record-tab-panel')];for(const panel of sections){const lines=[];const clone=panel.cloneNode(true);clone.querySelectorAll('script,style,button,.tooth-local-popup,[data-tooth-quick-popover],[data-tooth-charge-popover],.consultation-summary-overlay').forEach(el=>el.remove());clone.querySelectorAll('input,select,textarea').forEach(el=>{const label=el.closest('label')?.innerText||el.name||'Field';const value=el.tagName==='SELECT'?el.selectedOptions?.[0]?.textContent:(el.type==='checkbox'?(el.checked?'Yes':'No'):el.value);const span=document.createElement('span');span.textContent=' '+clean(label)+': '+clean(value)+' ';el.replaceWith(span);});clone.querySelectorAll('tr').forEach(tr=>{const val=[...tr.querySelectorAll('td,th')].map(c=>clean(c.textContent)).filter(Boolean).join(' | ');if(val&&!seen.has(val)){lines.push(val);seen.add(val);}});clone.querySelectorAll('.tooth-unit').forEach(tooth=>{const num=tooth.dataset.tooth||tooth.querySelector('.tooth-number')?.textContent;const status=tooth.dataset.condition||tooth._toothRecord?.condition||([...tooth.classList].find(x=>x.startsWith('tooth-')&&x!=='tooth-unit')||'').replace('tooth-','');const val=`Tooth ${num||'?'}: ${status||'Unrecorded'}`;if(!seen.has(val)){lines.push(val);seen.add(val);}});clone.querySelectorAll('h2,h3,h4,p,li,dt,dd,.info-item,.record-detail,.chart-legend').forEach(el=>{const text=clean(el.textContent);if(text&&text.length<700&&!seen.has(text)){lines.push(text);seen.add(text);}});fields.push({head:labels[panel.dataset.recordPanel]||panel.dataset.recordPanel||'Patient Details',lines});}
 try{const id=dialog.dataset.patientId;const records=JSON.parse(localStorage.getItem('cerilloPatientToothBilling')||'[]').filter(v=>String(v.patientId)===String(id));if(records.length){fields.push({head:'Saved Procedures',lines:records.flatMap(r=>r.type==='consultation-invoice'&&Array.isArray(r.items)?r.items:[r]).map(r=>`Tooth ${r.tooth||'-'} | ${r.finding||'-'} | ${r.procedure||'-'} | Amount ${r.price||r.amount||'-'}`)});}}catch(_){}
 return fields;
}
document.addEventListener('click',e=>{const button=e.target.closest('[data-export-patient-pdf],[data-export-current-patient-pdf]');if(!button)return;e.preventDefault();e.stopImmediatePropagation();const dialog=button.closest('dialog.clinical-record-modal')||document.querySelector('dialog.clinical-record-modal[open]')||document.querySelector('dialog.clinical-record-modal');if(!dialog){alert('Open a patient record before exporting.');return;}const name=clean(dialog.dataset.patientName||dialog.querySelector('.patient-file-header h3')?.textContent||'Patient');makePdf(`Patient Record - ${name}`,patientData(dialog),`Cerillo-Patient-Record-${name}.pdf`);},true);
window.CerilloDownloadPdf=makePdf;
})();
