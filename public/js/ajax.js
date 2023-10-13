//  ^ USER - REGISTER
$(document).ready(function () {
  
    $("#pseudo").on("input", function() {
        let pseudo = $(this).val();
       
        $.ajax({
            type: "POST",
            url:"index.php?action=checkRegister",
            data : {pseudo: pseudo},
            success: function(response) {
                $("#registerMessage").text(response);
             
            }
        });
    });


    $("#email").on("focusout", function () {
        let email =$(this).val();
        $.ajax ({
            type: "POST",
            url: "index.php?action=checkRegister",
            data : {email: email},
            success: function(response) {
                $("#registerMessage").text(response);
            } 
        });
    });

    $("#pass2").on("blur", function() {
        let pass2 = $(this).val();
        $.ajax ({
            type : "POST",
            url : "index.php?action=checkRegister",
            data : {pass2: pass2},
            success: function(response) {
                $("#registerMessage").text(response);
            }
        })
    })
});


//  ^ MOVIE - ADD A MOVIE
 
$("#movie_title").on("input", function() {
    console.log("click")
    let movie_title =$(this).val();
    console.log(movie_title)

    $.ajax({
        type : "POST",
        url : "index.php?action=checkMovie",
        data : {movie_title: movie_title},
            success: function(response) {
                $("#movieMessage").text(response);
            }
     });
});


//  ^ MOVIE - ADD AN ACTOR
 
$("#person_first_name, #person_last_name").on("input", function() {
    // console.log("click")
    const firstName = $("#person_first_name").val();
    const lastName = $("#person_last_name").val();
    

    if (firstName && lastName) {
        const actorName = { firstName, lastName };
        let actorNameStr = firstName + " " + lastName;
        console.log("actor name", actorName)
        console.log("actor name str", actorNameStr)

    $.ajax({
        type : "POST",
        url : "index.php?action=checkActor",
        data : {actorName: actorName},
            success: function(response) {
                console.log("response 1", response)
                // const result = JSON.parse(response);
                // console.log("response 2", response)
                $("#actorMessage").text(response.message)
                
            }
        });
    }
});

//  ^ ROLE - ADD A ROLE

$("#name_role").on("input", function() {
    console.log("click")
    let name_role =$(this).val();
    console.log(name_role)

    $.ajax({
        type : "POST",
        url : "index.php?action=checkRole",
        data : {name_role: name_role},
            success: function(response) {
                $("#roleMessage").text(response);
            }
     });
});


//  ^ GENRE - ADD A GENRE

$("#label_genre").on("input", function() {
    console.log("click")
    let label_genre =$(this).val();
    console.log(label_genre)

    $.ajax({
        type : "POST",
        url : "index.php?action=checkGenre",
        data : {label_genre: label_genre},
            success: function(response) {
                $("#genreMessage").text(response);
            }
     });
});

  // modèle  2

//   $("#person_first_name, #person_last_name").on("input", function () {
//     const firstName = $("#person_first_name").val();
//     const lastName = $("#person_last_name").val();

//     // Vérifier si les deux champs sont remplis
//     if (firstName && lastName) {
//         const actorName = { firstName, lastName };

//         $.ajax({
//             type: "POST",
//             url: "index.php?action=checkActor",
//             data: actorName,
//             success: function (response) {
//                 // Le serveur devrait renvoyer une réponse JSON, par exemple :
//                 // { exists: true } si l'acteur existe déjà
//                 // { exists: false } si l'acteur n'existe pas encore
//                 const result = JSON.parse(response);
//                 if (result.exists) {
//                     $("#actorMessage").text("Cet acteur existe déjà.");
//                 } else {
//                     $("#actorMessage").text("Cet acteur n'existe pas encore.");
//                 }
//             }
//         });
//     }
// });


// modèle 

// $("#person_first_name, #person_last_name").on("input", function() {
//     let firstName = $("#person_first_name").val();
//     let lastName = $("#person_last_name").val();

//     if (firstName && lastName) {
//         // Les deux champs sont remplis, vous pouvez effectuer la vérification AJAX
//         let actorName = firstName + " " + lastName;
//         console.log("actor name", actorName);

//         $.ajax({
//             type: "POST",
//             url: "index.php?action=checkActor",
//             data: { actorName: actorName },
//             success: function(response) {
//                 $("#actorMessage").text(response);
//             }
//         });
//     }
// });











