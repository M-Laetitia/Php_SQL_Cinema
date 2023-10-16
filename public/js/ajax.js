// ^ LIKES / DISLIKES
// & ADD LIKES
$(document).on("click", ".fa-solid.fa-heart.fa-heart-click", function () {
  let reviewId = $(this).data("id_review");
  $.ajax({
    type: "POST",
    url: "index.php?action=addLike",
    data: { review_id: reviewId },
    success: function (response) {
      if (response.success) {
        if (response.likeAction == "liked") {
          $(".fa-heart-click[data-id_review='" + reviewId + "']").addClass(
            "likedIcon"
          );
        } else if (response.likeAction == "unliked") {
          $(".fa-heart-click[data-id_review='" + reviewId + "']").removeClass(
            "likedIcon"
          );
        }
      }
    },
  });

  var urlParams = new URLSearchParams(window.location.search);
  var filmId = urlParams.get("id");

  $.ajax({
    type: "POST",
    url: "index.php?action=getReviewLikesDislikesCount",
    data: {
      review_id: reviewId,
      film_id: filmId,
    },
    dataType: "json",
    success: function (response) {
    
      response.forEach(function (review) {
        var reviewId = review.id_rating;
        var likes = review.likes;
        var dislikes = review.dislikes;
        var likesCountElement = $(
          ".likes-count[data-id_review='" + reviewId + "']"
        );
        var dislikesCountElement = $(
          ".dislikes-count[data-id_review='" + reviewId + "']"
        );
        likesCountElement.text(likes);
        dislikesCountElement.text(dislikes);
      });
    },
  });
});


//  & ADD DISLIKES
$(document).on("click", ".fa-solid.fa-heart-crack", function () {
  let reviewId = $(this).data("id_review");
  $.ajax({
    type: "POST",
    url: "index.php?action=addDislike",
    data: { review_id: reviewId },
    success: function (response) {
      if (response.success) {
        if (response.likeAction == "disliked") {
          $(".fa-heart-crack[data-id_review='" + reviewId + "']").addClass(
            "dislikedIcon"
          );
        } else if (response.likeAction == "undisliked") {
          $(".fa-heart-crack[data-id_review='" + reviewId + "']").removeClass(
            "dislikedIcon"
          );
        }
      }
    },
  });

  var urlParams = new URLSearchParams(window.location.search);
  var filmId = urlParams.get("id");

  $.ajax({
    type: "POST",
    url: "index.php?action=getReviewLikesDislikesCount",
    data: {
      review_id: reviewId,
      film_id: filmId,
    },
    dataType: "json",
    success: function (response) {
      response.forEach(function (review) {
        var reviewId = review.id_rating;
        var likes = review.likes;
        var dislikes = review.dislikes;
        var likesCountElement = $(
          ".likes-count[data-id_review='" + reviewId + "']"
        );
        var dislikesCountElement = $(
          ".dislikes-count[data-id_review='" + reviewId + "']"
        );
        likesCountElement.text(likes);
        dislikesCountElement.text(dislikes);
      });
    },
  });
});


// & KEEP LIKE/DISLIKE ICON STATE
$(document).ready(function () {
  var urlParams = new URLSearchParams(window.location.search);
  var filmId = urlParams.get("id");

  $.ajax({
    type: "POST",
    url: "index.php?action=checkLikedReviews",
    data: { film_id: filmId },

    success: function (response) {
      response.forEach((review) => {
        var reviewId = review.id_rating;
        if (review.is_like == 1) {
          var likesCountElement = $(
            ".fa-heart[data-id_review='" + reviewId + "']"
          );
          likesCountElement.addClass("likedIcon");
        } else {
          var likesCountElement = $(
            ".fa-heart[data-id_review='" + reviewId + "']"
          );
          likesCountElement.removeClass("likedIcon");
        }

        if (review.is_like == 0) {
          var likesCountElement = $(
            ".fa-heart-crack[data-id_review='" + reviewId + "']"
          );
          likesCountElement.addClass("dislikedIcon");
        } else {
          var likesCountElement = $(
            ".fa-heart-crack[data-id_review='" + reviewId + "']"
          );
          likesCountElement.removeClass("dislikedIcon");
        }
      });
    },
    error: function (error) {
      console.error("Error when adding a like or a dislike : " + error);
    },
  });
});


// ^ REVIEW
//  & ADD REVIEW
$(document).ready(function () {
  $("#reviewForm").submit(function (event) {
    event.preventDefault();
    var $form = $(this);
    var movieId = $form.data("movieid");
    var reviewTitle = $form.find("input[name='review_title']").val();
    var reviewText = $form.find("textarea[name='review_text']").val();

    $.ajax({
      type: "POST",
      url: "index.php?action=ajouterReview&id=" + movieId,
      data: {
        review_title: reviewTitle,
        review_text: reviewText,
      },

      success: function (response) {
        
        if (response.success) {
          $("#reviewMessage").text(response.message);

          afficherCritiques();
        } else {
          $("#reviewMessage").text(response.message);
          afficherCritiques();
        }
      },
    });
  });
  afficherCritiques();
});

//  & DISPLAY REVIEW
function afficherCritiques() {
  var movieId = $("#submitReview").data("movieid");
  var url = "index.php?action=afficherCritiquesFilm&id=" + movieId;

  $.ajax({
    type: "GET",
    url: url,
    dataType: "json",
    success: function(response) {
      var reviewsDiv = $(".movie-review");
      reviewsDiv.empty();
      response.forEach(review => {
        var pseudo = review.pseudo;
        var date_review = review.formatted_duration;
        var id_rating = review.id_rating;
        var likes = review.nb_likes; 
        var dislikes = review.nb_dislikes;
        var rating = review.note;
        var reviewData = JSON.parse(review.reviewComplete);


        var reviewAll = $("<div class='review-all'>");

        var reviewLikes = $("<div class='review-likes'>");
        var review = $("<div class='review'>");

        var titleRate = $("<div class='title_rate'>");
        var title = $("<p>").text("Title: " + reviewData.title);
        var note = $("<p>").text( "★" + rating  );

        var text= $("<div class='text'>");
        var textReview = $("<p>").text("Text: " + reviewData.text);

        var reviewId =  id_rating;

        var likesDiv = $("<div  id='" + reviewId + "' class='likesDiv'>");
        var likesCount = $("<span class='likes-count' data-id_review='" + reviewId + "'>" + likes + "</span>");

        var likeIcon = $("<i data-id_review='" + reviewId + "' class='fa-solid fa-heart fa-heart-click'></i>");

        var dislikeIcon = $("<i data-id_review='" + reviewId + "' class='fa-solid fa-heart-crack'></i>");
        var dislikesCount = $("<span class='dislikes-count' data-id_review='" + reviewId + "'>" + dislikes + "</span>");

        likesDiv.append(likeIcon, likesCount, dislikeIcon, dislikesCount )

        var pseudoDate = $("<div class='pseudo-date'>");
        var author = $("<p>").text(pseudo);
        var date = $("<p>").text(" - " + date_review);

        titleRate.append(title, note )
        text.append(textReview);
        pseudoDate.append(author, date);

        review.append(titleRate,text, likesDiv )

        reviewLikes.append(review, likesDiv)

        reviewAll.append(reviewLikes, pseudoDate)
        reviewsDiv.append(reviewAll)

      });
    }
  })
}

// ^ RATING
//  & ADD RATING / UPDATE RATING
$(document).ready(function () {
  // Fonction pour mettre à jour la moyenne des notes
  function updateAverageRating() {
    var urlParams = new URLSearchParams(window.location.search);
    var filmId = urlParams.get("id");

    $.ajax({
      type: "POST",
      url: "index.php?action=getAverageRating&id=" + filmId,
      dataType: "json",
      success: function (response) {
        if (response.noteMoyenne) {
          var averageRatingContainer = $(".average-rating");
          averageRatingContainer.empty(); // Efface tout contenu précédent

          var noteMoyenne = parseFloat(response.noteMoyenne); // Convertir en nombre
          for (var i = 1; i <= 5; i++) {
            if (i <= noteMoyenne) {
              averageRatingContainer.append(
                '<i class="fa-solid fa-star fa-lg star-filled"></i>'
              );
            } else {
              averageRatingContainer.append(
                '<i class="far fa-star fa-lg star-empty"></i>'
              );
            }
          }
        }
      },
      error: function (error) {
        console.error(
          "Erreur lors de la récupération de la moyenne des notes : " + error
        );
      },
    });
  }

  function getNumberRating() {
    var urlParams = new URLSearchParams(window.location.search);
    var filmId = urlParams.get("id");

    $.ajax({
      type: "POST",
      url: "index.php?action=getNumberRating&id=" + filmId,
      dataType: "json",
      success: function (response) {
        if (response.nb_note) {
          $("#ratingNumber").text("Ratings (" + response.nb_note + ")");
        }
      },
      error: function (error) {
        console.error(
          "Erreur lors de la récupération de la moyenne des notes : " + error
        );
      },
    });
  }

  $("#rating-form").submit(function (event) {
    event.preventDefault();
    var $form = $(this);
    var movieId = $form.data("movieid");
    var userRating = $form.find("input[name='user_rating']").val();

    $.ajax({
      type: "POST",
      url: "index.php?action=addRating&id=" + movieId,
      data: { user_rating: userRating },

      success: function (response) {
        if (response.success) {
          $("#reviewMessage").text(response.message);
        } else {
          $("#reviewMessage").text(response.message);
        }
      },
    });
  });

  updateAverageRating();
  getNumberRating();
});
