(()=>{'use strict';
const root=document.getElementById('reports');if(!root)return;
const button=[...root.querySelectorAll('button')].find(b=>/export report/i.test(b.textContent));if(!button)return;
button.dataset.cerilloExportReport='';
button.addEventListener('click',async e=>{
 e.preventDefault();e.stopImmediatePropagation();const label=button.textContent;button.disabled=true;button.textContent='Preparing PDF...';
 try{
  const period=root.querySelector('#reportsPeriodFilter')?.value||'this_month';
  const res=await fetch('/api/reports?'+new URLSearchParams({period}),{cache:'no-store',headers:{Accept:'application/json'}});
  if(!res.ok)throw new Error('Reports API responded with '+res.status);
  const r=await res.json();if(typeof window.CerilloDownloadPdf!=='function')throw new Error('PDF generator is unavailable.');
  const number=n=>Number(n||0).toLocaleString('en-PH');
  const money=n=>'PHP '+Number(n||0).toLocaleString('en-PH',{minimumFractionDigits:2,maximumFractionDigits:2});
  const blocks=[
   {head:'Reporting Period',lines:[r.period_label||period,`From: ${r.from||'-'}  To: ${r.to||'-'}`]},
   {head:'Key Performance Indicators',lines:[`Patients served: ${number(r.patients_served)}`,`Completed visits: ${number(r.completed_visits)}`,`Completion rate: ${number(r.completion_rate)}%`,`Cancelled visits: ${number(r.cancelled_visits)}`,`No-show visits: ${number(r.no_show_visits)}`,`Cancellation rate: ${number(r.cancellation_rate)}%`,`New patients: ${number(r.new_patients)}`,`Collections: ${money(r.total_revenue)}`,`Recall due: ${number(r.recall_due)}`,`Active treatment plans: ${number(r.active_treatment_plans)}`]},
   {head:'Monthly Visit Trends',lines:(r.monthly_visits||[]).map(m=>`${m.month||m.label||m.name||'-'}  |  ${number(m.visits??m.count??m.total??m.value)} visits`)},
   {head:'Service Utilization',lines:(r.services||[]).map(s=>`${s.name||'-'}  |  ${number(s.cases)} cases  |  ${number(s.share)}% share`)},
   {head:'Detailed Appointment Register',lines:(r.appointment_details||[]).map(a=>[a.date,a.time,a.patient,a.dentist,a.service,a.status].map(v=>String(v||'-')).join('  |  '))}
  ];
  window.CerilloDownloadPdf('Reports and Analytics',blocks,`Cerillo-Clinic-Report-${r.from||period}-${r.to||''}.pdf`);
 }catch(err){console.error('Report PDF export:',err);alert('Unable to export report: '+err.message);}finally{button.disabled=false;button.textContent=label;}
},true);
})();