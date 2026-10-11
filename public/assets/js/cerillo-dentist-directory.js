(()=>{'use strict';const ids=['frontReassignDentist','publicRequestDentist'];
async function load(){let dentists;try{const response=await fetch('/api/public/dentists',{headers:{Accept:'application/json'},cache:'no-store'});if(!response.ok)throw Error('Could not load clinicians');dentists=await response.json();}catch(e){console.warn(e);return;}
if(!Array.isArray(dentists))return;
for(const id of ids){const el=document.getElementById(id);if(!el)continue;const old=el.value;el.replaceChildren();for(const d of dentists){const option=document.createElement('option');option.value=String(d.id);option.textContent=d.name;el.append(option);}if([...el.options].some(opt=>opt.value===old))el.value=old;}
}
document.addEventListener('DOMContentLoaded',()=>{load();document.querySelectorAll('#frontAppointmentModal,#publicRequestReviewModal').forEach(modal=>modal.addEventListener('click',()=>{}, {once:true}));});
})();