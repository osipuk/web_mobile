const mongoose = require("mongoose");
const Schema = mongoose.Schema;

var ContactSchema = new Schema(
  {
    userID: {
      type: String,
      default: ""
    },
    phoneNumber: {
      type: String,
      default: ""
    },
    labelName: {
      type: String,
      default: ""
    }
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model("Contact", ContactSchema);
