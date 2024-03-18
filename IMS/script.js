//===================page loading event==============================================================================
         const links = document.querySelectorAll('a'); // Select all anchor tags

links.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Show the loading page
        document.body.innerHTML = '<iframe src="load.html" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; border: none;"></iframe>';

        // Delay navigation to the target page for at least 2 seconds
        setTimeout(function() {
            window.location.href = link.href; // Redirect to the target page
        }, 2000); // Delay for 2 seconds (2000 milliseconds)
    });
});

function cancelShow(){
    document.getElementById('show').style.display = 'none';
}
function ShowCart(){
    document.getElementById('show').style.display = 'block';
}

function displayLog(){
    document.querySelector('.user-box').style.display = 'block';
}  
function cancelLog(){
    document.querySelector('.user-box').style.display = 'none';
} 
function displaymenu(){
    document.querySelector('.navbar').style.display = 'block';
}
 
function cancelmenu(){
    document.querySelector('.navbar').style.display = 'none';
}

let closebtn = document.getElementById('close_form');
closebtn.addEventListener('click', ()=>{
    document.querySelector('.update').style.display = 'none';
})
function canceledit(){
    document.querySelector('.update').style.display = 'none';
}
document.addEventListener('click', function(event){

    var button = document.getElementById('button');
    var dropdown =  document.querySelector('.user-box');
           
    if(!button.contains(event.target) && !dropdown.contains(event.target)){
        dropdown.style.display = 'none';
    }
});



/*

 //JavaScript to show the loading spinner when a link is clicked
document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function() {
        document.getElementById('loading').style.display = 'block';
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a'); // Select all anchor tags

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Show the loading page
            document.body.innerHTML = '<iframe src="loading.html" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; border: none;"></iframe>';

            // Delay navigation to the target page for at least 2 seconds
            setTimeout(function() {
                window.location.href = link.href; // Redirect to the target page
            }, 2000); // Delay for 2 seconds (2000 milliseconds)
        });
    });
});
*/




