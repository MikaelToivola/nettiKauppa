const teeKuvat = (json) => {
  let output = '';

  for (let i in json) {
    console.log('FOR LOOP' + i);

    output += '<li class="omattuotteet">' +
        '<figure>' +
        '<a href="ilmoitussivu.php?kID=' + json[i].ID + '"><img src="' + //json[i].KUVA + 'thumbs/' + json[i].thumb +
         json[i].thumb + '"></a>' +
        '<figcaption>' +
        '<h3>' + json[i].NIMI + '</h3>' +
        '<h3>' + json[i].ID + '</h3>' +

        '<form class="delete-form_kayttaja" method="POST" >' +
        '<input type="hidden"  name="myynti_id" value="' +json[i].ID + '">' +
        '<input type="hidden"  name="myynti_kuva" value="' +json[i].KUVA + '">' +
        '<input type="hidden"  name="myynti_video" value="' +json[i].video + '">' +
        '<input type="hidden"  name="myynti_audio" value="' +json[i].audio + '">' +
        '<button type="submit" name="poista_ilmoitus" id="ilmoitus_poisto">poista </button>' +
        '</form>' +

        //  '<h1>' + json[i].KATEGORIA + '</h1>' +
        '<p>' + json[i].HINTA + '€' + '</p>' +

        '</figcaption>' +
        '</figure>' +
        '</li>';
  }
  console.log(output);
  document.querySelector('#kuvat').innerHTML = output;

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
xhr.open('GET', 'omattiedot_print.php');
xhr.onreadystatechange = showImages;
xhr.send();





//});