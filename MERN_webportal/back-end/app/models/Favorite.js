const mongoose = require("mongoose");
const Schema = mongoose.Schema;

var FavoriteSchema = new Schema(
  {
    email: {
      type: String,
      default: ""
    },
    from_number: {
      type: String,
      default: ""
    },
    to_number: {
      type: String,
      default: ""
    },
    favorite: {
      type: String,
      default: "0"
    },
    unfavorite: {
      type: String,
      default: "0"
    }
  },
  {
    timestamps: true
  }
);

module.exports = mongoose.model("Favorite", FavoriteSchema);
