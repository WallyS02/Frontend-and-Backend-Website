function button1(){
    var btn = document.createElement("wiki");
    var textnode = document.createTextNode("Niestety, więcej znajdziesz tylko na wikipedii :( ");
    btn.appendChild(textnode);
    document.getElementById("pran").appendChild(btn);
}

function button2(){
    document.getElementById("s1").style.fontSize='25px';
    document.getElementById("s2").style.fontSize='25px';
    document.getElementById("button1").style.fontSize='25px';
}

function button3(){
    document.designMode = "on";
    alert("Oczywiście tylko dla siebie!");
}

$( function() {
    $( "#dialog" ).dialog({
        autoOpen: false
})
    $(".audi").on('click', function(e) {
        e.preventDefault();
        $('#dialog').dialog('open');
});
} );

$( function() {
    var handle = $( "#custom-handle" );
    $( "#slider" ).slider({
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value );
      },
      max: 10
    });
    
} );

$(function () {
    $('.Menu span.expand').click(function () {
        $('.Menu h4').toggle(300);
    })
}
);

function loc(){
    let store = document.getElementById("fname").value;
    localStorage.setItem("fname", store);
    var p = localStorage.getItem("fname");
    document.getElementById("local").innerText = "Witaj na stronie "+p+"!";
}

function imie(){
    var p = localStorage.getItem("fname");
    if(!p){
        document.getElementById("local").innerText = "Witaj na stronie użytkowniku!";
    }
    else {
        document.getElementById("local").innerText = "Witaj na stronie "+p+"!";
    }
}

function save_ses(){
    var store = document.getElementById("opinion").value;
    sessionStorage.setItem("save", store);
}

function load_ses(){
    var store = sessionStorage.getItem("save");
    document.getElementById("opinion").value = store;
}