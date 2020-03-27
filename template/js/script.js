function countPrice(){
    var  priceProduct= document.getElementById("price_product");
    var  kolvo= document.getElementById("example-number-input");
    var b=price;
    var a=kolvo.value;
    var d=a*b;
    priceProduct.innerText=d;
}	


import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';

import PendingActions from '@ckeditor/ckeditor5-core/src/pendingactions';

let isDirty = false;

ClassicEditor
    .create( document.querySelector( '#editor' ), {
        plugins: [
            PendingActions,

            // ... other plugins
        ]
    } )
    .then( editor => {
        window.editor = editor;

        handleStatusChanges( editor );
        handleSaveButton( editor );
        handleBeforeunload( editor );
    } )
    .catch( err => {
        console.error( err.stack );
    } );

// Handle clicking the "Save" button by sending the data to a
// fake HTTP server (emulated here with setTimeout()).
function handleSaveButton( editor ) {
    const saveButton = document.querySelector( '#save' );
    const pendingActions = editor.plugins.get( 'PendingActions' );

    saveButton.addEventListener( 'click', evt => {
        const data = editor.getData();

        // Register the action of saving the data as a "pending action".
        // All asynchronous actions related to the editor are tracked like this,
        // so later on you only need to check `pendingActions.hasAny` to check
        // whether the editor is busy or not.
        const action = pendingActions.add( 'Saving changes' );

        evt.preventDefault();

        // Save the data to a fake HTTP server.
        setTimeout( () => {
            pendingActions.remove( action );

            // Reset isDirty only if the data did not change in the meantime.
            if ( data == editor.getData() ) {
                isDirty = false;
            }

            updateStatus( editor );
        }, HTTP_SERVER_LAG );
    } );
}

// Listen to new changes (to enable the "Save" button) and to
// pending actions (to show the spinner animation when the editor is busy).
function handleStatusChanges( editor ) {
    editor.plugins.get( 'PendingActions' ).on( 'change:hasAny', () => updateStatus( editor ) );

    editor.model.document.on( 'change:data', () => {
        isDirty = true;

        updateStatus( editor );
    } );
}

// If the user tries to leave the page before the data is saved, ask
// them whether they are sure they want to proceed.
function handleBeforeunload( editor ) {
    const pendingActions = editor.plugins.get( 'PendingActions' );

    window.addEventListener( 'beforeunload', evt => {
        if ( pendingActions.hasAny ) {
            evt.preventDefault();
        }
    } );
}

function updateStatus( editor ) {
    const saveButton = document.querySelector( '#save' );

    // Disables the "Save" button when the data on the server is up to date.
    if ( isDirty ) {
        saveButton.classList.add( 'active' );
    } else {
        saveButton.classList.remove( 'active' );
    }

    // Shows the spinner animation.
    if ( editor.plugins.get( 'PendingActions' ).hasAny ) {
        saveButton.classList.add( 'saving' );
    } else {
        saveButton.classList.remove( 'saving' );
    }
}

// function showHint(str) {
//     if (str.length == 0) {
//         document.getElementById("txtHint").innerHTML = "";
//         return;
//     } else {
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.getElementById("txtHint").innerHTML = this.responseText;
//             }
//         };
//         xmlhttp.open("GET", "Search.php?q=" + str, true);
//         xmlhttp.send();
//     }
// }
// function addhref(){

//     var kolvo= document.getElementById("example-number-input").value;
//     var add = document.getElementById("buttonAdd");
//     console.log(href);
//     href+=kolvo;
//     console.log(href);
//     add.href=href;
// }
// function showWindow() {
//     var el = document.getElementById("content_window");
//     // var el1 = document.getElementsByClassName("login");
//     // el1.style.position='absolute';
//     el.style.display = 'block';
//     el.style.zIndex='1000';
// }
// function closeWindow(){
//     var el = document.getElementById("content_window");
//     el.style.display='none';
// }
// let response = await fetch("http://blog/api/users/stat/");

// if (response.ok) { // если HTTP-статус в диапазоне 200-299
//   // получаем тело ответа (см. про этот метод ниже)
//   let json = await response.json();
// } else {
//   alert("Ошибка HTTP: " + response.status);
// }
