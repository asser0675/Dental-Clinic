(()=>{'use strict';
const ids=['frontReassignDentist','publicRequestDentist','adminCalendarDentistFilter'];
async function load(){
  let dentists;
  try{
    const response=await fetch('/api/public/dentists',{headers:{Accept:'application/json'},cache:'no-store'});
    if(!response.ok)throw Error('Could not load clinicians');
    dentists=await response.json();
  }catch(e){console.warn(e);return;}
  if(!Array.isArray(dentists))return;
  for(const id of ids){
    const el=document.getElementById(id);
    if(!el)continue;
    const oldVal=el.value;
    const placeholder=id==='adminCalendarDentistFilter'?'All dentists':'Select dentist';
    el.replaceChildren();
    const defOpt=document.createElement('option');
    defOpt.value='';
    defOpt.textContent=placeholder;
    el.append(defOpt);
    for(const d of dentists){
      const option=document.createElement('option');
      option.value=String(d.id);
      option.textContent=d.name;
      option.dataset.name=d.name;
      el.append(option);
    }
    if(oldVal && [...el.options].some(opt=>opt.value===oldVal)){
      el.value=oldVal;
    }
  }
}
document.addEventListener('DOMContentLoaded',()=>{load();});
})();