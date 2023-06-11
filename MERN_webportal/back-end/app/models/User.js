const mongoose = require("mongoose");
const Schema = mongoose.Schema;

var UserSchema = new Schema(
  {
    email: {
      type: String,
      default: ""
    },
    phoneNumber: {
      type: String,
      default: ""
    },
    style_mode: {
      type: String,
      default: "dark"
    },
    emailAlert: {
      type: Boolean,
      default: false
    }
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model("User", UserSchema);
