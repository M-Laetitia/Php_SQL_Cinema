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


//  ^ ADD like

$(document).ready(function() {
    $(".fa-solid.fa-heart.fa-heart-click").on("click", function() {
        console.log("click");
        let reviewId = $(this).data("id_review");
        console.log("check review id:" , reviewId);

        $.ajax ({
            type : "POST",
            url : "index.php?action=addLike",
            data : {review_id: reviewId},
            
            success : function(response) {
                console.log(response)
                console.log("data:",  reviewId  )
                if(response.success) {
                console.log("réponse", response)
                    if(response.likeAction == "liked") {
                        
                        // $(".fa-solid.fa-heart.fa-heart-click[data-id_review='" + reviewId + "']").removeClass(".likes.fa-heart");

                        $(".fa-heart-click[data-id_review='" + reviewId + "']").addClass("likedIcon");
                        console.log("logo id" , reviewId)

                    } else if (response.likeAction == "unliked") {
                        $(".fa-heart-click[data-id_review='" + reviewId + "']").removeClass("likedIcon");
                    }
                }
            }
        })
    })
});

//  ^ ADD dislike

$(document).ready(function() {
    $(".fa-solid.fa-heart-crack").on("click", function() {
        console.log("click");
        let reviewId = $(this).data("id_review");
        console.log("check review id:" , reviewId);

        $.ajax ({
            type : "POST",
            url : "index.php?action=addDislike",
            data : {review_id: reviewId},
            
            success : function(response) {
                console.log(response)
                console.log("data:",  reviewId  )
                if(response.success) {
                console.log("réponse", response)
                    if(response.likeAction == "disliked") {

                        $(".fa-heart-crack[data-id_review='" + reviewId + "']").addClass("dislikedIcon");
                        console.log("logo id" , reviewId)

                    } else if (response.likeAction == "undisliked") {
                        $(".fa-heart-crack[data-id_review='" + reviewId + "']").removeClass("dislikedIcon");
                    }
                }
            }
        })
    })
});

// ^ ADD a rating 
$(document).ready(function() {
    $("#submitForm").on("submit", function (event) {
        event.preventDefault();


        let movieRating = $form.find("input[name='user_rating']").val();

        $.ajax({
            type: "POST",
            url : "index.php?action=addRating",
            data : {
                note : movieRating
            },
        success: function(response) {
            if(response.success) {
                $(".fa-solid.fa-x.fa-lg").addClass("rated"); 
            }
       
        }
        })
        
    })
})



//  ^ Check review liked - keep the style change on the icon
// requête pour récupérer les likes/dislikes d'un utilisateur actuel pour les reviews
// $(document).ready(function () {
//     $.ajax({
//         type : "POST",
//         url : "index.php?action=checkLikedReviews",

//         success: function (response) {
//             console.log("isliked réponse 1", response )
//             response = JSON.parse(response);
//             console.log("isliked réponse 2", response )

//             response.forEach(review => {
//                 var reviewId = review.id_review_like;
//                 var isLiked = review.isLiked;
//                 var isDisliked = review.isDisliked;

//                 if (isLiked == 1 ) {
//                     $(".fa-heart-click[data-id_photo='" + reviewId + "']").addClass("likedIcon");
//                 } else {
//                     $(".fa-heart-click[data-id_photo='" + reviewId + "']").removeClass("likedIcon");
//                 }


//                 if (isDisliked == 0 ) {
//                     $(".fa-heart-click[data-id_photo='" + reviewId + "']").addClass("dislikedIcon");
//                 } else {
//                     $(".fa-heart-click[data-id_photo='" + reviewId + "']").removeClass("dislikedIcon");
//                 }
//             });
//         },
//         error : function(error) {
//             console.error ("Error when adding a like or a dislike : " + error);
//         }
//     });
// });



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











