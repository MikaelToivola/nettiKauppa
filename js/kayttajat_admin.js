const teeTyypit = (json) => {
  let output = '';

  for (let i in json) {
    console.log('FOR LOOP' + i);

    output += '<li class="ilmoituskuvat">' +
        '<figure>' +
       /* '<a href="admin_ilmoitus.php?kID=' + json[i].id + '"><img src="' + //json[i].KUVA +
        json[i].thumb + '"/></a>' + */
        '<figcaption>' +
        '<h3>' + json[i].username + '</h3>' +
        '<h3>' + json[i].id + '</h3>' +

        //  '<h1>' + json[i].KATEGORIA + '</h1>' +
        '<form class="delete-form_admin" method="POST" >' +
        '<input type="hidden"  name="kayttaja_id" value="' +json[i].id + '">' +
        '<input type="hidden"  name="kayttaja_kuva" value="' +json[i].avatar + '">' +
        /* '<input type="hidden"  name="myynti_video" value="' +json[i].video + '">' +
         '<input type="hidden"  name="myynti_audio" value="' +json[i].audio + '">' + */
        '<button type="submit" name="poista_ilmoitus">poista </button>' +
        '</form>' +

        '</figcaption>' +
        '</figure>' +
        '</li>';
  }
  console.log(output);
  document.querySelector('#tyypit').innerHTML = output;
//  document.querySelector('#jotain').innerHTML = xhr.responseText;
};

const xhr = new XMLHttpRequest();

const showImages = function() {

  if (xhr.readyState === 4 && xhr.status === 200) {

    console.log('xhr.responseText = '+xhr.responseText);
    const json = JSON.parse(xhr.responseText);



    teeTyypit(json);
  }
};

//console.log('showImages');
xhr.open('GET', 'haku.php');
xhr.onreadystatechange = showImages;
xhr.send();