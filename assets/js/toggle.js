let switches = document.querySelectorAll('.ios-switch')
const prevBtns = document.querySelectorAll(".prev")
const nextBtns = document.querySelectorAll(".next")
const formSteps = document.querySelectorAll(".form-step")
let formStepsNum = 0;
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

nextBtns.forEach((btn) =>{
    btn.addEventListener("click", () => {
      formStepsNum ++;
      updateFormSteps();
    });
});

prevBtns.forEach((btn) =>{
    btn.addEventListener("click", () => {
      formStepsNum --;
      updateFormSteps();
    });
});

function updateFormSteps(){
    formSteps.forEach((formStep) => {
        formStep.classList.contains("active") &&
        formStep.classList.remove("active");
    });
    formSteps[formStepsNum].classList.add("active");
}