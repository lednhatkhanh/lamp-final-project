$('#registerForm').validate({
  rules: {
    username: "required",
    password: "required",
    passwordConfirm: "required",
    username: {
      required: true
    },
    password: {
      required: true
    },
    passwordConfirm: {
      required: true,
      equalTo: "#password"
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
    },
    passwordConfirm: {
      required: "Please enter a password",
      equalTo: "Please enter the same password as above"
    }
  }
});
