
function validation()
{
    const firstname=document.getElementById('name').value.trim();
    const email=document.getElementById('email').value.trim();
    const mobile=document.getElementById('mobile').value;
    const address=document.getElementById('address').value.trim();
    const password=document.getElementById('password').value;
    const userType=document.getElementById('userType').innerHTML = "";

    const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(firstname=="")
    {
        document.getElementById("nameerr").innerHTML="Name is empty";
        return false;    
    }

    if (firstname.length<3) 
    {
            document.getElementById("nameerr").innerHTML="Name must be at least 3 characters long";
            return false; 
    }

    if (userType=="") {
        document.getElementById("typeerr").innerHTML="Please select a user type";
        isValid = false;
    }

    if(email=="")
    {
        document.getElementById("emailerr").innerHTML="Email is empty";
        return false;    
    }

    if(mobile=="")
    {
        document.getElementById("mobileerr").innerHTML="Mobile is empty";
        return false;    
    }

    if(mobile.length!=11)
    {
        document.getElementById("mobileerr").innerHTML="Mobile number must contain 11 digits";
        return false;    
    }

    if(address=="")
    {
        document.getElementById("addresserr").innerHTML="Address is empty";
        return false;    
    }

    if(password=="")
    {
        document.getElementById("passworderr").innerHTML="Email is empty";
        return false;  
    }

    if (password.length < 8) 
    {
            document.getElementById("passworderr").innerHTML="Password must be at least 8 characters long";
            return false; 
    }

    if(!/[A-Z]/.test(password))
    {
        document.getElementById("passworderr").innerHTML="Password must contain at least one uppercase letter";
        return false;
    }

    if(!/[a-z]/.test(password))
    {
        document.getElementById("passworderr").innerHTML="Password must contain at least one lowercase letter";
        return false;
    }

    if(!/[0-9]/.test(password))
    {
        document.getElementById("passworderr").innerHTML="Password must contain at least one digit";
        return false;
    }

    if(!/[!@#$%^&*]/.test(password))
    {
        document.getElementById("passworderr").innerHTML="Password must contain at least one special character";
        return false;
    }

    if (!emailRegex.test(email)) 
    {
        document.getElementById("error").innerHTML="Enter a valid email address.";
        return false;
    }


    return true;

}

document.getElementById('mobile').addEventListener("keypress", function(e) 
{
    if (!/[0-9]/.test(e.key)) 
    {
        e.preventDefault(); 
    }
});

document.getElementById('name').addEventListener("keypress", function(e) 
{
    document.getElementById("nameerr").innerHTML="";
});

document.getElementById('email').addEventListener("keypress", function(e) 
{
    document.getElementById("emailerr").innerHTML="";
});

document.getElementById('mobile').addEventListener("keypress", function(e) 
{
        document.getElementById("mobileerr").innerHTML="";    
});

document.getElementById('address').addEventListener("keypress", function(e) 
{
    document.getElementById("addresserr").innerHTML="";
});

document.getElementById('password').addEventListener("keypress", function(e) 
{
    document.getElementById("passworderr").innerHTML="";
});