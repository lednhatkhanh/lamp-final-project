$('#changePostForm').validate({
  rules: {
    title: "required",
    postContent: "required",
    title: {
      required: true
    },
    postContent: {
      required: true
    }
  },
  messages: {
    title: "Please enter title",
    postContent: "Please enter content",
    title: {
      required: "Please enter a title"
    },
    postContent: {
      required: "Please enter the content"
    }
  }
});
