function signUp()
{
    console.log(document.getElementById('user').value + ' '+document.getElementById('pass').value);
    $.post('backend/register.php',{operation:'register',user:document.getElementById('user').value,pass:document.getElementById('pass').value},function(data, status){console.log(data);});

    document.getElementById('user').value = '';
    document.getElementById('pass').value = '';
}


