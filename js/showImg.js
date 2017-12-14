const teeKuvat = (json) => {
  let output = '';

  for (let i in json) {
    console.log('FOR LOOP' + i);

    output += '<li class="ilmoituskuvat">' +
        '<figure>' +
        '<a href="ilmoitussivu.php?kID=' + json[i].ID + '"><img src="' + //json[i].KUVA +
         json[i].thumb + '"/></a>' +
        '<figcaption>' +
        '<h3>' + json[i].NIMI + '</h3>' +
        //'<h3>' + json[i].ID + '</h3>' +

        //  '<h1>' + json[i].KATEGORIA + '</h1>' +
        '<p>' + json[i].HINTA + '€' +  '</p>' +

        '</figcaption>' +
        '</figure>' +
        '</li>';
  }
  //console.log(output);
  document.querySelector('#kuvat').innerHTML = output;
//  document.querySelector('#jotain').innerHTML = xhr.responseText;
};


const xhr = new XMLHttpRequest();

const showImages = function() {

  if (xhr.readyState === 4 && xhr.status === 200) {

    console.log('xhr.responseText = '+xhr.responseText);
    const json = JSON.parse(xhr.responseText);



    teeKuvat(json);
  }
};

console.log('showImages');
xhr.open('GET', 'haku.php');
xhr.onreadystatechange = showImages;
xhr.send();

document.querySelector('#tuotehaku').addEventListener('submit', (evt) => {
  evt.preventDefault();
  const data = new FormData(document.querySelector('#tuotehaku'));
  const asetukset = {

    method: 'POST',
    body: data
  }

  fetch('haku.php', asetukset).then((response) => {
    return response.json();
  }).then((json) => {
    teeKuvat(json);
  });



});


