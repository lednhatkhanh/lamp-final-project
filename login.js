$('#loginForm').validate({
  rules: {
    username: "required",
    password: "required",
    username: {
      required: true
    },
    password: {
      required: true
    }
  },
  messages: {
    username: "Please enter your username",
    password: "Please enter your password",
    username: {
      required: "Please enter a username"
    },
    password: {
      required: "Please enter a password"
    }
  }
});
