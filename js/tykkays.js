const tykkays = document.querySelector('.tykkaa');


const like = () => {
  fetch('tykkays.php').then((response) => {
    return response.text();
  }).then((text) => {
    console.log(text);
    console.log("teksti on tässä yläpuolella");
   // let html = '';
   // json.forEach((kuva) => {
 /*     html += `<li>
                   <figure>
    <a href="img/original/${kuva.mediaUrl}"><img src="img/thumbs/${kuva.mediaThumb}"></a>
        <figcaption>
        <h3>${kuva.mediaTitle}</h3>
                  </figcaption>
             </figure>
        </li>`;
    }); */

  })
};


tykkays.addEventListener('click', (evt) => {
  evt.preventDefault();
  console.log('tykätty on');
  like();
});

