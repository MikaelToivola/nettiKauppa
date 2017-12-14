const menunappi = document.querySelector('#topmenu li:first-child');
const menunapit = document.querySelectorAll('#topmenu li');

const naytaNapit =  (evt) => {
  evt.preventDefault();
  console.log("NÄYTÄ NAPIT");
  menunapit.forEach((nappi) => {
    nappi.style = "display: list-item";
  });
  menunappi.removeEventListener('click', naytaNapit);
  menunappi.addEventListener('click', piilotaNapit);
};

const piilotaNapit = (evt) =>{
  evt.preventDefault();
  menunapit.forEach((nappi) => {
    nappi.style = "display: none";
  });
  menunappi.style = "display: list-item";
  menunappi.removeEventListener('click', piilotaNapit);
  menunappi.addEventListener('click', naytaNapit);
};

menunappi.addEventListener('click', naytaNapit);


window.addEventListener('resize', (evt) => {
  if(window.innerWidth > 600){
    naytaNapit(evt);
    menunappi.style = "display: none";
  } else {
    piilotaNapit(evt);
    menunappi.style = "display: list-item";
  }
});




