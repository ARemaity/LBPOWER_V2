

//TODO:get uid for the new added user

document.getElementById("register").addEventListener("click", function () {

    
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var repassword = document.getElementById("repassword").value;
  var city = document.getElementById("city").value;
  var street = document.getElementById("street").value;
  var phone = document.getElementById("phone").value;
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var cname = document.getElementById("cname").value;
  var capacity = document.getElementById("capacity").value;

  if (cname === "" || capacity === "" ||city === "" || fname === "" || lname === "" || street === "" || phone === "" || email === "" || password === "" || repassword === "") {
    location.reload();
    window.alert("please all fields");

  } else if (password != repassword) {
    window.alert("please renter same password");
    document.getElementById("password").innerHTML = "";
    document.getElementById("repassword").innerHTML = "";

  } else {

   
        console.log("it enter hahaha")
    
          var xhr = new XMLHttpRequest();

          xhr.onload = function () {
    
            window.alert(this.responseText);
          };
          xhr.open("POST", 'register.php', true);
    
          //Send the proper header information along with the request
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("fname=" + fname + "&lname=" + lname + "&phone=" + phone + "&city=" + city + "&street=" + street +"&cname=" + cname + "&capacity=" + capacity+ "&email=" + email);
          
    // window.alert(city+" "+street+" "+phone+" "+fname+" "+lname);
    
   
}
  
});














// xhr.send(new Int8Array()); 
// xhr.send(document);