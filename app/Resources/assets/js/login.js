$(function() {
    var usernameEl = $('#username');
    var passwordEl = $('#password');

    // in a real application, hardcoding the user/password would be idiotic
    // but for the demo application it's very convenient to do so
    if (!usernameEl.val() && !passwordEl.val()) {
        usernameEl.val('jane_admin');
        passwordEl.val('kitten');
    }
});
