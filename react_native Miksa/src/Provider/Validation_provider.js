
class Validation_provider {

  digitCheck = async (text)=>{
    const latters = /^[0-9]+$/;
    let res = latters.test(text);
    return res;
  }

  decimalCheck=(text)=>{
    const latters = /^\d+(\.\d{1,2})?$/;
    let res = latters.test(text);
    return res;
  }
  spaceCheck=(text)=>{
    var regexp = /^\S*$/;
    let res = regexp.test(text);
    return res;
  }

  textCheck=(text)=>{
    const letters = /^[a-zA-Z- ]+$/;
    let res = letters.test(text);
    return res;
  }

  emailCheck=(text)=>{
    const letters = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let res = letters.test(text);
    return res;
  }

  getURLParameterName=async(name,url) =>{
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexString = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexString);
    var found = regex.exec(url);
    if(found == null)
    return "";
    else
    return decodeURIComponent(found[1].replace(/\+/g, " "));
  }
  
  getPageName=async(url)=> {
    //var filename = document.location.href.match(/[^\/]+$/)[0];
      var index = url.lastIndexOf("/") + 1;
      var filenameWithExtension = url.substr(index);
      var filename = filenameWithExtension.split(".")[0]; // <-- added this line
      return filename;                                    // <-- added this line
  }
  

   
}

export const validationprovider = new Validation_provider();

