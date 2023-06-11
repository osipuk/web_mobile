const axios= require ("axios");
const fs = require('fs'); 
const Message = require("./models/Message");
const User = require("./models/User");
const Favorite = require("./models/Favorite");
const Contact = require("./models/Contact");
const crypto = require("crypto");
const http = require("http");
const path = require("path");

const nodemailer = require("nodemailer");
// const sendgridtransport = require("nodemailer-sendgrid-transport");
const config = require("../config/config"); // load the database config

const transport = nodemailer.createTransport({
    host: config.server_name,
    port: 25,
    secure: false, // true for 465, false for other ports
    auth: {
      user: config.user_name, // generated ethereal user
      pass: config.password // generated ethereal password
    }
  });

const CronJob = require("cron").CronJob;
const job = new CronJob("0 */2 * * * *", function() {

  const time1 = new Date(Date.now() - 35 * 60 * 1000);
  const time2 = new Date(Date.now() - 5 * 60 * 1000);
  console.log(time1,time2,'this is cron job');
  Message.find(
    {
      state: "0",
      email_alert: true,
      createdAt: {
        $gte: time1,
        $lte: time2
      }
    },
    function(err, result) {
      console.log(result,'ttt');
      if (err) {
        console.log(err);
      } else if (result && result.length > 0) {
        console.log(result,'result is the cron result');
        const array =
          result.length > 1
            ? result.filter(
                (elem, index, self) =>
                  self.findIndex(
                    t =>
                      t.from_number === elem.from_number &&
                      t.to_number === elem.to_number &&
                      t.createdAt.replace(/\.\d+/, "") ===
                        elem.createdAt.replace(/\.\d+/, "")
                  ) === index
              )
            : result;
        array.forEach(arr => {
          User.find(
            {
              phoneNumber: arr.to_number,
              emailAlert: true
            },
            function(err, res) {
              if (res) {
                res.forEach(r => {
                  console.log(r.email,'this is cron job sendmailer');
                  sendMailer(r.email, r.phoneNumber);
                  Message.updateOne(
                    {
                      _id: arr._id
                    },
                    { $set: { email_alert: false } },
                    function(err, result) {
                      if (err) {
                        return err;
                      }
                    }
                  );
                });
              }
            }
          );
        });
      }
    }
  );
});

const job1 = new CronJob("* * * 30 * *", function() {
  console.log('this is cron for 30 days');
  const pathToDir = path.join(__dirname, "../public/mms_images");
  removeDir(pathToDir)
});
job1.start()
const download_image = (url, image_path) =>
  axios({
    url,
    auth: {
          username: config.apiToken,
          password: config.apiSecret,
        } ,  
    responseType: 'stream',
  }).then(
    response =>
      new Promise((resolve, reject) => {
        response.data
          .pipe(fs.createWriteStream(image_path))
          .on('finish', () => resolve())
          .on('error', e => reject(e));
      }),
  );

 function removeDir(path) {
    if (fs.existsSync(path)) {
      const files = fs.readdirSync(path)
        console.log(files.length,'file length');
       if (files.length > 0) {
        files.forEach(function(filename) {
          if (fs.statSync(path + "/" + filename).isDirectory()) {
            removeDir(path + "/" + filename)
          } else {
            fs.unlinkSync(path + "/" + filename)
          }
       })
        //fs.rmdirSync(path)
       } 
       //else {
      //   fs.rmdirSync(path)
      // }
    } else {
      console.log("Directory path not found.")
    }
  }

function sendMailer(userMail, phoneNum) {
  console.log("mail Sender");
  const fromMail =config.sender_email; //"joel@tsicloud.com";
  const text = `You have unread text messages to ${phoneNum}. Go to http://upotrtal.ztellatech.com to check and respond to these messages`;
  const subject = "ZellaTech SMS Notification";
  const email = {
    from: fromMail,
    to: userMail,
    subject: subject,
    html: text
  };
  transport.sendMail(email, function(err, info) {
    if (err) {
      console.log("error");
    } else {
      console.log("Message sent: " + info);
    }
  });
}
job.start();

module.exports = function(app, io) {
  
  app.get("/", function(req, res) {
    res.writeHead(200, {'Content-Type': 'text/plain'});
    res.end("Server running\n");
  })
  app.post("/userchk", function(req, res) {
    console.log('this is post',req.body.email);
    User.findOne(
      {
        email: req.body.email
      },
      function(err, result) {
        if (!result) {
          const userData = {
            email: req.body.email
          };
          User.create(userData, function(err1, res1) {
            if (err1) {
              return;
            } else {
              res.send([]);
            }
          });
        } else {
          res.send(result);
        }
      }
    );
  });
  app.post("/callback", function(req, res) {    
    let callback = req.body[0];
    console.log('callback!');
    if (callback && callback.type === "message-received") {   
      const setTime = new Date(new Date().getTime() - 30 * 60 * 1000);
      const msgTime = new Date(callback.time);
      if (setTime < msgTime) {
        console.log(callback,'this is callback');
        let message = callback.message;
        Message.findOne(
          {
            message_id: message.id
          },
          async function(err, result) {
        
            if (!result) {
              let msgData;
              console.log('this is result',result);         
              //  if (result && result.media) {
                if (message.media) {
                console.log('this is media message!');
                let filename = crypto.randomBytes(15).toString("hex")+".JPG"
                await download_image(message.media[1], './public/mms_images/'+filename);
                msgData = {
                  from_number: message.from,
                  to_number: callback.to,
                  text: message.text,
                  direction: "in",
                  state: "0",
                  media: "http://pgrtal.zelglatech.com:8080/mms_images/"+filename,
                  message_id: message.id
                };
              } else {
                console.log('this is no media message!');
                msgData = {
                  from_number: message.from,
                  to_number: callback.to,
                  text: message.text,
                  state: "0",
                  direction: "in",
                  message_id: message.id
                };
              }
              Message.create(msgData, function(err1, res1) {
                if (res1) {
                  let data = {
                    state: "success",
                    fromNumber: res1.from_number,
                    toNumber: res1.to_number
                  };
                  io.emit("incomMessage", data);
                }
              });
            }
          }
        );
      }
    }
    if (callback && callback.type === "message-delivered") {
      let message = callback.message;
      const setTime = new Date(new Date().getTime() - 30 * 60 * 1000);
      const msgTime = new Date(callback.time);
      if (setTime < msgTime) {
        Message.findOne(
          {
            message_id: message.id
          },
          function(err, result) {
            if (result && result.state === "0" && result.media) {
              let data = {
                state: "success",
                fromNumber: result.from_number,
                toNumber: result.to_number
              };
              io.emit("incomMessage", data);
            }
          }
        );
      }
    }
  }); 
  app.get("/cron", function(req, res) {    
    //path.join(__dirname, "/public/mms_images");    
    const pathToDir = path.join(__dirname, "../public/mms_images");

    removeDir(pathToDir)
    console.log('callback1!');
    res.json(path.join(__dirname, "../public/mms_images"));
   
  });
  app.post("/sendmessage", function(req, res) {
    console.log(req.body,'this is sendmessage');
    const { from_number, to_number, text } = req.body.sendMsgData;
    // const { from, to, text } = req.body[0].message;
    // var from_number=from;
    // var to_number=to;
    Message.create(req.body.sendMsgData, function(err, resu) {
      if (err) {
        res.send(err);
      } else {
        Message.find(
          {
            $or: [
              { from_number: from_number, to_number: to_number },
              { from_number: to_number, to_number: from_number }
            ]
          },
          null,
          { sort: { createdAt: "asc" } },
          function(err, result) {
            if (err) {
              console.log(err);
            } else {
              res.send(result);
            }
          }
        );
      }
    });
  });
  app.post("/getmessages", function(req, res) {
    console.log(req.body,'this is getmessages');
   const { fromNumber, toNumber } = req.body.msgData;
  //  const { from, to } = req.body[0].message;
  //  var  fromNumber=from;
  //  var  toNumber=to;
    if (toNumber && fromNumber) {
      Message.find(
        {
          $or: [
            { from_number: fromNumber, to_number: toNumber },
            { from_number: toNumber, to_number: fromNumber }
          ]
        },
        null,
        { sort: { createdAt: "asc" } },
        function(err, result) {
          if (err) {
            console.log(err);
          } else {
            res.send(result);
            Message.updateMany(
              {
                $or: [
                  { from_number: fromNumber, to_number: toNumber },
                  { from_number: toNumber, to_number: fromNumber }
                ]
              },
              { $set: { state: 1 } },
              function(err, result) {
                if (err) {
                  return err;
                }
              }
            );
          }
        }
      );
    }
  });
  app.post("/getprintmessages", function(req, res) {
    const { fromNumber, toNumber, startDate, endDate } = req.body.msgData;

    if (startDate === endDate) {
      Message.find(
        {
          $or: [
            { from_number: fromNumber, to_number: toNumber },
            { from_number: toNumber, to_number: fromNumber }
          ],
          createdAt: {
            $gte: startDate
          }
        },
        null,
        { sort: { createdAt: "asc" } },
        function(err, result) {
          if (err) {
            console.log(err);
          } else {
            res.send(result);
          }
        }
      );
    } else {
      Message.find(
        {
          $or: [
            { from_number: fromNumber, to_number: toNumber },
            { from_number: toNumber, to_number: fromNumber }
          ],
          createdAt: {
            $gte: startDate,
            $lte: endDate
          }
        },
        null,
        { sort: { createdAt: "asc" } },
        function(err, result) {
          if (err) {
            console.log(err);
          } else {
            res.send(result);
          }
        }
      );
    }
  });
  app.post("/getnumbers", function(req, res) {
    const { userNumber, email } = req.body;
    const array = [];
    let numberArray = [];
    let contactList = [];
    Favorite.find(
      {
        email: email,
        from_number: userNumber
      },
      function(err, result) {
        if (err) {
          console.log(err);
        } else {
          numberArray = result;
        }
      }
    );
    Contact.find(
      {
        userID: email
      },
      function(err, result) {
        if (err) {
          console.log(err);
        } else {
          contactList = result;
        }
      }
    );

    Message.find(
      { $or: [{ from_number: userNumber }, { to_number: userNumber }] },
      { from_number: 1, to_number: 1, _id: 0 },
      { sort: { createdAt: "desc" } },
      function(err, result) {
        if (err) {
          console.log(err);
        } else {
          result &&
            result.map(res => {
              if (res.from_number === userNumber) {
                array.push({ memberNum: res.to_number });
              }
              if (res.to_number === userNumber) {
                array.push({ memberNum: res.from_number });
              }
            });

          const arr = array.filter(
            (v, i, a) => a.findIndex(t => t.memberNum === v.memberNum) === i
          );
          let notifies = [];
          let index = 0;
          arr.forEach(num => {
            Message.find(
              {
                $or: [
                  {
                    from_number: num.memberNum,
                    to_number: userNumber,
                    state: "0",
                    direction: "in",
                    media: { $eq: "" }
                  },
                  {
                    from_number: num.memberNum,
                    to_number: userNumber,
                    state: "0",
                    direction: "out",
                    media: { $ne: "" }
                  }
                ]
              },
              null,
              { sort: { createdAt: "desc" } },
              function(err, result) {
                if (result && result.length > 0) {
                  notifies.push({
                    number: num.memberNum,
                    newMsg: result.length
                  });
                }
                index++;
                if (index === arr.length) {
                  let normal =
                    numberArray.length === 0
                      ? arr
                      : arr.filter(
                          o1 =>
                            !numberArray.some(
                              o2 => o1.memberNum === o2.to_number
                            )
                        );
                  let favorite = arr.filter(o1 =>
                    numberArray.some(
                      o2 =>
                        o1.memberNum === o2.to_number &&
                        o2.email === email &&
                        o2.favorite === "1"
                    )
                  );

                  let normalList = [],
                    favoriteList = [];
                  if (normal.length > 0) {
                    normal.forEach(num => {
                      if (contactList.length > 0) {
                        let obj = contactList.find(
                          contactNum => num.memberNum === contactNum.phoneNumber
                        );
                        if (obj) {
                          normalList.push({
                            memberNum: num.memberNum,
                            labelName: obj.labelName,
                            contactID: obj._id
                          });
                        } else {
                          normalList.push({
                            memberNum: num.memberNum,
                            labelName: "",
                            contactID: ""
                          });
                        }
                      } else {
                        normalList.push({
                          memberNum: num.memberNum,
                          labelName: "",
                          contactID: ""
                        });
                      }
                    });
                  }
                  if (favorite.length > 0) {
                    favorite.forEach(num => {
                      if (contactList.length > 0) {
                        let obj = contactList.find(
                          contactNum => num.memberNum === contactNum.phoneNumber
                        );
                        if (obj) {
                          favoriteList.push({
                            memberNum: num.memberNum,
                            labelName: obj.labelName,
                            contactID: obj._id
                          });
                        } else {
                          favoriteList.push({
                            memberNum: num.memberNum,
                            labelName: "",
                            contactID: ""
                          });
                        }
                      } else {
                        favoriteList.push({
                          memberNum: num.memberNum,
                          labelName: "",
                          contactID: ""
                        });
                      }
                    });
                  }
                  res.send({
                    // members: arr,
                    notifies: notifies,
                    normalMem: normalList,
                    favoriteMem: favoriteList
                    // contactList: contactList
                  });
                  return;
                }
              }
            );
          });
        }
      }
    );
  });

  app.post("/getunreadmessage", function(req, res) {
    const { userNumber } = req.body;
    Message.find(
      {
        $or: [
          {
            to_number: userNumber,
            state: "0",
            direction: "in",
            media: { $eq: "" }
          },
          {
            to_number: userNumber,
            state: "0",
            direction: "out",
            media: { $ne: "" }
          }
        ]
      },
      null,
      { sort: { createdAt: "desc" } },
      function(err, result) {
        if (result && result.length > 0) {
          res.send({ count: result.length });
        } else {
          res.send({ count: 0 });
        }
      }
    );
  });

  app.post("/saveusernumber", function(req, res) {
    console.log(req.body.email,req.body.phoneNumber,"/saveuserNumber");
    User.findOneAndUpdate(
      {
        email: req.body.email
      },
      { $set: { phoneNumber: req.body.phoneNumber } },
      function(err, result) {
        if (err) {
          return err;
        } else {
          res.send(result);
        }
      }
    );
  });
  app.post("/savestylemode", function(req, res) {
    User.findOneAndUpdate(
      {
        email: req.body.email
      },
      { $set: { style_mode: req.body.styleMode } },
      function(err, result) {
        if (err) {
          return err;
        } else {
          res.send(result);
        }
      }
    );
  });
  app.post("/savemailalert", function(req, res) {
    User.findOneAndUpdate(
      {
        email: req.body.email
      },
      { $set: { emailAlert: req.body.emailAlert } },
      function(err, result) {
        if (err) {
          return err;
        } else {
          res.send(result);
        }
      }
    );
  });
  app.post("/fileupload", (req, res, next) => {
    let imageFile = req.files.file;
    var filename = crypto.randomBytes(15).toString("hex");
    imageFile.mv(`${__dirname}/../public/mms_images/${filename}.jpg`, function(
      err
    ) {
      if (err) {
        return res.status(500).send(err);
      }
      res.json({ file: `${filename}.jpg` });
    });
  });

  app.post("/sendcontact", (req, res, next) => {


    const email = {
      from: config.sender_email,
      to: req.body.toMail,
      subject: req.body.subject,
      html: '<span>'+req.body.text+'</span>'+'<p>Submitted by <b>'+req.body.fromMail+'<b></p>'
     // html: req.body.text+"\n  From "+req.body.fromMail
    };

    console.log(email);
   
    transport.sendMail(email, function(err, info) {
      if (err) {
        console.log("error");
      } else {
        res.send("Message sent: " + info.response);
      }
    });
  });
  app.post("/deleteconversation", (req, res) => {
    
    const { fromNumber, toNumber } = req.body.msgData;
    console.log('this is remove deleteconversation',fromNumber,toNumber);
    Message.deleteMany(
      {
        $or: [
          { from_number: fromNumber, to_number: toNumber },
          { from_number: toNumber, to_number: fromNumber }
        ]
      },
      function(err, resu) {
        if (!resu) {
          console.log(err);
        } else {
          res.send(resu);
        }
      }
    );
  });
  app.post("/addfavorite", (req, res) => {
    const { fromNumber, toNumber, email } = req.body.msgData;
    Favorite.findOne(
      {
        email: email,
        from_number: fromNumber,
        to_number: toNumber
      },
      function(err, result) {
        if (!result) {
          const saveData = {
            email: email,
            from_number: fromNumber,
            to_number: toNumber,
            favorite: "1"
          };
          Favorite.create(saveData, function(err1, res1) {
            if (err1) {
              return;
            } else {
              res.send(res1);
            }
          });
        }
      }
    );
  });

  app.post("/deletefavorite", (req, res) => {
    console.log('delete cfavorites');
    const { fromNumber, toNumber, email } = req.body.msgData;
    Favorite.deleteOne(
      {
        email: email,
        from_number: fromNumber,
        to_number: toNumber
      },
      function(err, result) {
        if (result) {
          res.send(result);
        }
      }
    );
  });
  app.post("/adduserlabel", (req, res) => {
    const { userID, phoneNumber, labelName, contactID } = req.body.msgData;
    const data = {
      userID: userID,
      phoneNumber: phoneNumber,
      labelName: labelName
    };
    if (!contactID) {
      Contact.findOne(
        {
          userID: data.userID,
          phoneNumber: data.phoneNumber
        },
        function(err, result) {
          if (!result) {
            Contact.create(data, function(err1, res1) {
              if (err1) {
                return;
              } else {
                res.send(res1);
              }
            });
          }
        }
      );
    } else {
      Contact.updateOne(
        {
          _id: contactID
        },
        { $set: { labelName: labelName } },
        function(err, result) {
          if (err) {
            return err;
          } else {
            res.send(result);
          }
        }
      );
    }
  });

  app.get("*", function(req, res) {
    res.sendFile(__dirname + "/public/index.html"); // load the single view file (angular will handle the page changes on the front-end)
  });
};
