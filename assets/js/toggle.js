let switches = document.querySelectorAll('.ios-switch')

for(var i =0; i < switches.length; i++)
{
    switches[i].addEventListener('click',
    function(event){
       if(this.classList.contains('active'))
       {
           this.classList.remove('active');
           this.querySelector('input[type=checkbox').checked = false;
       }
       else{
           this.classList.add('active');
           this.querySelector('input[type=checkbox').checked = true;
       }
    })
}