const suljeNappi = document.querySelector('.closeBtn')
const suljeNappi2 = document.querySelector('.closeBtn2');;
const modal = document.querySelector('#modal');
const modal2 = document.querySelector('#modal2');

const linkkiTapahtumat = () => {

  const linkit = document.querySelectorAll('#tuotetiedot a.video');
  const linkit2 = document.querySelectorAll('#tuotetiedot a.audio');
  console.log('linkkitapahtumat!!!!!');
  //lisää jokaiseen linkkiin click event
  // klikatessa hae href ja laita se modalin img:n src:n arvoksi
  //vaihda modalin luokaksi lightbox hiddenin sijaan
  // linkit.forEach((linkki) => {
  console.log(linkit);

  linkit.forEach( (linkki) => {
    linkki.addEventListener('click', (evt) => {

      evt.preventDefault();

      const href = linkki.getAttribute('href');
      console.log(linkki);
      modal.querySelector('video').setAttribute('src', href);  //=src=href;
      modal.classList.replace('hidden', 'lightbox');
      modal.classList.add('animated', 'slideInDown');
    });
  });


  linkit2.forEach( (linkki) => {
    linkki.addEventListener('click', (evt) => {

      evt.preventDefault();

      const href = linkki.getAttribute('href');
      console.log(linkki);
      modal2.querySelector('audio').setAttribute('src', href);  //=src=href;
      modal2.classList.replace('hidden', 'lightbox');
      modal2.classList.add('animated', 'slideInDown');
    });
  });
  // const element = document.querySelector('ul');
  //  element.innerHTML = html;
  //linkit voi valita vasta tämän jälkeen eli html on nyt valmis
  // const linkit = element.querySelector('ul a');

  //});

  suljeNappi.addEventListener('click', (evt) => {
    evt.preventDefault();
    console.log('sulje nappi');
    //vaihda modalin luokka lightboxista hiddeniin
    modal.classList.replace('lightbox', 'hidden');

  });

  suljeNappi2.addEventListener('click', (evt) => {
    evt.preventDefault();
    console.log('sulje nappi');
    //vaihda modalin luokka lightboxista hiddeniin
    modal2.classList.replace('lightbox', 'hidden');

  });


};

const getParameterByName = (name, url) => {
  if (!url) url = window.location.href;
  name = name.replace(/[\[\]]/g, '\\$&');
  const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
};

const xhr = new XMLHttpRequest();

const showImages = function() {

  if (xhr.readyState === 4 && xhr.status === 200) {

    console.log('xhr.responseText = ' + xhr.responseText);
    var json = JSON.parse(xhr.responseText);

    console.log('NONIIN ELI NYT KOKEILLAAN TAAS');

    let output = '';

    for (let i in json) {
      console.log('FOR LOOP' + i);

      output += '<li class="ilmoitussivu">' +
          '<figure id="ilmoituskuva_fig">' +
          '<img id="isokuva" src= "' +     ///thumbs/+ json[i].thumb
          '' + json[i].KUVA + '">' +

         // '<a  id="tykkaa" href="tykkays.php">Like</a>' +
          '<figcaption>' +
          '<h1>' + json[i].NIMI + '</h1>' +
         // '<h3>' + json[i].KATEGORIA + '</h3>' +
          '<p>' + json[i].kuvaus + '</p>' +
          '<p>' + json[i].HINTA + '€' + '</p>' +
          '<p>' + json[i].email + '</p>' +

          '</figcaption>' +
          '</figure>' +
          '<div class="column"> '+

          '<a class="video" href="' + json[i].video + '"controls><img  id="videotykki" src= "siteImages/video_logo.png"' + //'thumbs/' +
          json[i].thumb +
          '></a>' +
          '<p> Katso video </p>' +

      '<a class ="audio" href="' + json[i].audio + '" controls><img id="titi" src=  "siteImages/titi.png"' +
             // json[i].thumb +
          '></a>' +
          '<p> Kuuntele audio </p>' +

          '</div>' +
          '</li>';
      console.log(json[i].video);

    }
    console.log(output);
    document.querySelector('#tuotetiedot').innerHTML = output;
    linkkiTapahtumat();

    //document.getElementById('json').innerHTML = json;
    //document.getElementById("resp").innerHTML =xhr.responseText;
  }
};
console.log('showImages');
xhr.open('GET', 'ilmoitus.php?kID=' + getParameterByName('kID'));
xhr.onreadystatechange = showImages;
xhr.send();







