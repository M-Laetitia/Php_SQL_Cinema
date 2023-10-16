//  ^ USER - REGISTER
$(document).ready(function () {
  $("#pseudo").on("input", function () {
    let pseudo = $(this).val();
    $.ajax({
      type: "POST",
      url: "index.php?action=checkRegister",
      data: { pseudo: pseudo },
      success: function (response) {
        $("#registerMessage").text(response);
      },
    });
  });
  $("#email").on("focusout", function () {
    let email = $(this).val();
    $.ajax({
      type: "POST",
      url: "index.php?action=checkRegister",
      data: { email: email },
      success: function (response) {
        $("#registerMessage").text(response);
      },
    });
  });
  $("#pass2").on("blur", function () {
    let pass2 = $(this).val();
    $.ajax({
      type: "POST",
      url: "index.php?action=checkRegister",
      data: { pass2: pass2 },
      success: function (response) {
        $("#registerMessage").text(response);
      },
    });
  });
});

//  ^ MOVIE - ADD A MOVIE
$("#movie_title").on("input", function () {
  let movie_title = $(this).val();
  $.ajax({
    type: "POST",
    url: "index.php?action=checkMovie",
    data: { movie_title: movie_title },
    success: function (response) {
      $("#movieMessage").text(response);
    },
  });
});

//  ^ MOVIE - ADD A PERSON (actor or director)
$("#person_first_name, #person_last_name").on("input", function () {
  let firstName = $("#person_first_name").val();
  let lastName = $("#person_last_name").val();
  $.ajax({
    type: "POST",
    url: "index.php?action=checkActor",
    data: {
      person_first_name: firstName,
      person_last_name: lastName,
    },
    success: function (response) {
      $("#personMessage").text(response.message);
    },
  });
});

//  ^ ROLE - ADD A ROLE
$("#name_role").on("input", function () {
  let name_role = $(this).val();
  $.ajax({
    type: "POST",
    url: "index.php?action=checkRole",
    data: { name_role: name_role },
    success: function (response) {
      $("#roleMessage").text(response);
    },
  });
});

//  ^ GENRE - ADD A GENRE
$("#label_genre").on("input", function () {
  let label_genre = $(this).val();
  $.ajax({
    type: "POST",
    url: "index.php?action=checkGenre",
    data: { label_genre: label_genre },
    success: function (response) {
      $("#genreMessage").text(response);
    },
  });
});
