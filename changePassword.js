$('#changePasswordForm').validate({
  rules: {
    oldPass: "required",
    newPass: "required",
    newPassConfirm: "required",
    oldPass: {
      required: true
    },
    newPass: {
      required: true
    },
    newPassConfirm: {
      required: true,
      equalTo: "#newPass"
    }
  },
  messages: {
    oldPass: "Please enter the current password!",
    newPass: "Please enter new password!",
    newPassConfirm: "Please enter the previous password again!",
    oldPass: {
      required: "Please enter the current password!"
    },
    newPass: {
      required: "Please enter new password!"
    },
    newPassConfirm: {
      required: "Please enter new password again!",
      equalTo: "Password does not match!"
    }
  }
});
