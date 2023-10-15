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

    const firstName = $("#person_first_name").val();
    const lastName = $("#person_last_name").val();
    

    $.ajax({
        type : "POST",
        url : "index.php?action=checkActor",
        data: {
            person_first_name: firstName,
            person_last_name: lastName
        },
            success: function(response) {
                console.log("response 1", response)

                $("#personMessage").text(response.message)
                
            }
        });
    
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

$(document).on("click", ".fa-solid.fa-heart.fa-heart-click", function() {

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
                        


                        $(".fa-heart-click[data-id_review='" + reviewId + "']").addClass("likedIcon");
                        console.log("logo id" , reviewId)

                    } else if (response.likeAction == "unliked") {
                        $(".fa-heart-click[data-id_review='" + reviewId + "']").removeClass("likedIcon");

                      
                    }

                }
            }
        })

        var urlParams = new URLSearchParams(window.location.search);
        var filmId = urlParams.get("id");

        $.ajax({
            type: "POST",
            url: "index.php?action=getReviewLikesDislikesCount",
            data: { review_id: reviewId,
                film_id: filmId },
            dataType: "json",          
            success: function(response) {
                console.log("la seocnde fonction se lance")
                response.forEach(function(review) {     
                    var reviewId = review.id_rating;
                    var likes = review.likes;
                    var dislikes = review.dislikes;


                var likesCountElement = $(".likes-count[data-id_review='" + reviewId + "']");
                var dislikesCountElement = $(".dislikes-count[data-id_review='" + reviewId + "']");
                likesCountElement.text(likes);
                dislikesCountElement.text(dislikes);
            });
        }
        });
    })


//  ^ ADD dislike

$(document).on("click", ".fa-solid.fa-heart-crack", function() {
        console.log("click");
        let reviewId = $(this).data("id_review");
        console.log("check review id:" , reviewId);

        $.ajax ({
            type : "POST",
            url : "index.php?action=addDislike",
            data : {review_id: reviewId},
            
            success : function(response) {
                // console.log(response)
                // console.log("data:",  reviewId  )

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

        var urlParams = new URLSearchParams(window.location.search);
        var filmId = urlParams.get("id");

        $.ajax({
            type: "POST",
            url: "index.php?action=getReviewLikesDislikesCount",
            data: { review_id: reviewId,
                film_id: filmId },
            dataType: "json",          
            success: function(response) {
                console.log("la seocnde fonction se lance")
                response.forEach(function(review) {     
                    var reviewId = review.id_rating;
                    var likes = review.likes;
                    var dislikes = review.dislikes;


                var likesCountElement = $(".likes-count[data-id_review='" + reviewId + "']");
                var dislikesCountElement = $(".dislikes-count[data-id_review='" + reviewId + "']");
                likesCountElement.text(likes);
                dislikesCountElement.text(dislikes);
            });
        }
        });
    })








//  ^ AJOUTER REVIEW
$(document).ready(function() {
    // afficherCritiques();
    
    $("#reviewForm").submit(function(event) {
        event.preventDefault();
        var $form = $(this);
        var movieId = $form.data("movieid");
        var reviewTitle = $form.find("input[name='review_title']").val();
        var reviewText = $form.find("textarea[name='review_text']").val();

        console.log(reviewTitle)
        console.log(reviewText)

    
        $.ajax({
            type: "POST",
            url : "index.php?action=ajouterReview&id=" + movieId,
            data: {
                review_title: reviewTitle,
                review_text: reviewText
            },
            
            success: function(response) {
                
                console.log("Review2 response:", response);
                if (response.success) {
                    $("#reviewMessage").text(response.message);

                    afficherCritiques();
                   
                } else {
                    $("#reviewMessage").text(response.message);
                    
                }

            }
        });
 
    });
    afficherCritiques();
});




//  ^ MOVIE RATING (ajax)
$(document).ready(function() {


    // Fonction pour mettre à jour la moyenne des notes
    function updateAverageRating() {
        var urlParams = new URLSearchParams(window.location.search);
        var filmId = urlParams.get("id");
        

        $.ajax({
            type: "POST",
            url: "index.php?action=getAverageRating&id=" + filmId,
            dataType: "json",
            success: function(response) {
                console.log("rep", response)

                if (response.noteMoyenne) {
                    
                    var averageRatingContainer = $(".average-rating");
                    averageRatingContainer.empty(); // Efface tout contenu précédent
    
                    var noteMoyenne = parseFloat(response.noteMoyenne); // Convertir en nombre
                    for (var i = 1; i <= 5; i++) {
                       
                        if (i <= noteMoyenne) {
                            averageRatingContainer.append('<i class="fa-solid fa-star fa-lg star-filled"></i>');
                            
                        } else {
                            averageRatingContainer.append('<i class="far fa-star fa-lg star-empty"></i>');
                        }
                    }
                }
            },
            error: function(error) {
                console.error("Erreur lors de la récupération de la moyenne des notes : " + error);
            }
        });
    }
    function getNumberRating() {
        var urlParams = new URLSearchParams(window.location.search);
        var filmId = urlParams.get("id");
        

        $.ajax({
            type: "POST",
            url: "index.php?action=getNumberRating&id=" + filmId,
            dataType: "json",
            success: function(response) {
               
                
                if (response.nb_note) {
                    $("#ratingNumber").text("Ratings (" + response.nb_note + ")");
                    
                }
            },
            error: function(error) {
                console.error("Erreur lors de la récupération de la moyenne des notes : " + error);
            }
        });
    }

    $("#rating-form").submit(function(event) {
        event.preventDefault();
        var $form = $(this);
        var movieId = $form.data("movieid");
        var userRating = $form.find("input[name='user_rating']").val();
        console.log(userRating)
    
        $.ajax({
            type: "POST",
            url : "index.php?action=addRating&id=" + movieId,
            data: { user_rating: userRating },
            
            success: function(response) {

                if (response.success) {
                    $("#reviewMessage").text(response.message);
                   
                } else {
                    $("#reviewMessage").text(response.message);
                }
            }
        });
    });

    updateAverageRating();
    getNumberRating()
});



//  ^ DISPLAY REVIEW

    function afficherCritiques() {
        // console.log("afficherCritiques function is called");
        var movieId = $("#submitReview").data("movieid");
        var url = "index.php?action=afficherCritiquesFilm&id=" + movieId;

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(response) {
                console.log("responses" , response);
                
                
                var reviewsDiv = $(".movie-review");
                // reviewsDiv.empty();

                response.forEach(review => {
                    console.log("review:" , review)
                    console.log("pseudo", review.pseudo
                    )

                    var pseudo = review.pseudo;
                    var date_review = review.formatted_duration;
                    var id_rating = review.id_rating;
                    var likes = review.nb_likes; 
                    var dislikes = review.nb_dislikes;

                    var reviewData = JSON.parse(review.reviewComplete);
                    console.log("reviewData" , reviewData)

                    
                    // Créee un conteneur pour chaque revue
                    var reviewAll = $("<div class='review-all'>");
                    // Créez un conteneur pour les détails de la revue
                    var reviewLikes = $("<div clasmos='review-likes'>");
                    var review = $("<div class='review'>");

                    var titleRate = $("<div class='title_rate'>");
                    var title = $("<p>").text("Title: " + reviewData.title);
                    var note = $("<p>").text("Note: " );

                    var text= $("<div class='text'>");
                    var textReview = $("<p>").text("Text: " + reviewData.text);

                    var reviewId =  id_rating;

                    var likesDiv = $("<div  id='" + reviewId + "' class='likesDiv'>");
                    var likesCount = $("<span class='likes-count' data-id_review='" + reviewId + "'>" + likes + "</span>");
    
                    var likeIcon = $("<i data-id_review='" + reviewId + "' class='fa-solid fa-heart fa-heart-click'></i>");

                    var dislikeIcon = $("<i data-id_review='" + reviewId + "' class='fa-solid fa-heart-crack'></i>");
                    var dislikesCount = $("<span class='dislikes-count' data-id_review='" + reviewId + "'>" + dislikes + "</span>");

                    likesDiv.append(likeIcon, likesCount, dislikeIcon, dislikesCount )


                    // var likeDislike = $("<p>").text("likes: " );

                    var pseudoDate = $("<div class='pseudo-date'>");
                    var author = $("<p>").text("author: " + pseudo);
                    var date = $("<p>").text("date: " + date_review);


                    titleRate.append(title, note )
                    text.append(textReview);
                    // likesDiv.append(likeDislike);
                    pseudoDate.append(author, date);

                    review.append(titleRate,text, likesDiv )

                    reviewLikes.append(review, likesDiv)

                    reviewAll.append(reviewLikes, pseudoDate)
                    reviewsDiv.append(reviewAll)
                });
            }
        });
    }
   


//  ^ Check review liked - keep the style change on the icon
// requête pour récupérer les likes/dislikes d'un utilisateur actuel pour les reviews
$(document).ready(function () {

  
    var urlParams = new URLSearchParams(window.location.search);
    var filmId = urlParams.get("id");
    console.log("récup id url page", filmId)
    

        $.ajax({
            type : "POST",
            url : "index.php?action=checkLikedReviews",
            data: { film_id: filmId},

            success: function (response) {
              
   
                response.forEach(review => {
                    var reviewId = review.id_rating;
                    if (review.is_like == 1) {
                        var likesCountElement = $(".fa-heart[data-id_review='" + reviewId + "']");
                        likesCountElement.addClass("likedIcon");

                    } else {
                        var likesCountElement = $(".fa-heart[data-id_review='" + reviewId + "']");
                        likesCountElement.removeClass("likedIcon");
                    }
    
                    if (review.is_like == 0) {
                        var likesCountElement = $(".fa-heart-crack[data-id_review='" + reviewId + "']");
                        likesCountElement.addClass("dislikedIcon");
                    } else {
                        var likesCountElement = $(".fa-heart-crack[data-id_review='" + reviewId + "']");
                        likesCountElement.removeClass("dislikedIcon");
                    }
                });
            },
            error : function(error) {
                console.error ("Error when adding a like or a dislike : " + error);
            }
        });
    

    });




//^ getting the number of review
// $.ajax({
//     type: "POST",
//     url: "index.php?action=getCommentCount",
//     success: function (response) {
//         response = JSON.parse(response);
//         if (response) {
//             response.forEach(photo =>
//                 $(".comment-count[data-id_photo='" + photo.id + "']").text(photo.comment_count)
//             );
//         }
//     },
//     // ...
// });