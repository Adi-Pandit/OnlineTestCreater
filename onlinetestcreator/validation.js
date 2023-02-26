function chkdept(){
  if(document.mform.department.value=="" || document.mform.department.value==" ")
  {
    alert("department name cannot be blank");
    document.mform.department.setfocus();
    return false;
  }
  var nmm=document.mform.department.value;
  if(nmm.match(/^[a-z A-Z]+$/))
  {
   return true;
  }
  else
  {
   alert("department name is not valid");
   return false;
 }
  
}

function chklt(){
  if(document.mform.leave_type.value=="" || document.mform.leave_type.value==" ")
  {
    alert("leave type cannot be blank");
    document.mform.leave_type.setfocus();
    return false;
  }
  var nmm=document.mform.leave_type.value;
  if(nmm.match(/^[a-z A-Z]+$/))
  {
   return true;
  }
  else
  {
   alert("leave type is not valid");
   return false;
 }
}
/*
function chkemail(){
  if(document.mform.email.value=="" || document.mform.email.value==" ")
 {
   alert("E Mail cannot be blank");
   document.mform.email.setfocus();
   return false
 }
 var mail2=/^\w+([\._]?\w+)*@\w+([\._]?\w+)*(\.\w{2,3})+$/;
 var mail1=document.mform.txtEm.value;
 if(mail1.match(mail2))
 { 
   return true;
  }
 else{ 
   alert("Email id invalid");
   return false;
}
}
*/
function chknm()
{ 
     
 if(document.mform.name.value=="" || document.mform.name.value==" ")
 {
   alert("Name cannot be blank");
   document.mform.name.setfocus();
   return false;
 }
 
 else if(document.mform.email.value=="" || document.mform.email.value==" ")
 {
   alert("E Mail cannot be blank");
   document.mform.email.setfocus();
   return false
 }
 else if(document.mform.mobile.value=="" || document.mform.mobile.value==" " || isNaN(document.mform.mobile.value))
 {
   alert("Enter correct phone number");
   document.mform.mobile.setfocus();
 }

 var nmm=document.mform.name.value;
 if(nmm.match(/^[a-z A-Z]+$/))
 {
  return true;
 }
 else
 {
  alert("Name is not valid");
  return false;
}

 var mail2=/^\w+([\._]?\w+)*@\w+([\._]?\w+)*(\.\w{2,3})+$/;
 var mail1=document.mform.email.value;
 if(mail1.match(mail2))
 { 
   return true;
  }
 else
 { alert("Email id invalid");
  return false;
}

var phone1=/^\d{10}$/;
var phone2=document.mform.mobile.value;
if(phone2.match(phone1))
{
  return true;
}
else
{
  alert("Invalid phone no.");
  return false;
}
  
}

