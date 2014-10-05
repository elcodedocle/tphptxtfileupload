/**
 * Performs validation checks and AJAX processing of upload file form
 */
var TxtFileUpload = function () {
  var tThis = this;
  this.validationSuccessCallback = function(){
    return true;
  };
  this.validationErrorCallback = function(params){
    window.alert(params.message);
    return false;
  };
  this.clientValidation = function (form){
    var fieldName = 'user';
    if (!form[fieldName].value.match(/[a-z0-9\._]{4,31}/i)){
      message = 'Invalid user name (Only 4-31 alphanumeric, dots and underscore characters allowed)';
      return tThis.validationErrorCallback({
        'form':form, 
        'fieldName':fieldName, 
        'message':message
      });
    }
    fieldName = 'theFile';
    if (!form[fieldName].files[0].name.match(/^([a-z0-9_]+|(-)*){1,123}\.txt$/i)){
      message = 'Invalid file (Must be a .txt file, no other dots or starting hyphens allowed on file name)'
      return tThis.validationErrorCallback({
        'form':form, 
        'fieldName':fieldName, 
        'message':message
      });
    }
    return tThis.validationSuccessCallback();
  };
  this.successCallback = function(response){
    window.alert(response.result.message);
  };
  this.errorCallback = function(response){
    window.alert(response.result.message);
  };
  this.setFormListener = function (form){
    form.addEventListener("submit", function (event) {
      event.preventDefault();
      if (tThis.clientValidation(form)){
        sendData(form);
      }
    });  
  };
  function sendData(form) {
    var XHR = new XMLHttpRequest(),
    FD  = new FormData(form);
    XHR.addEventListener("load", function(event) {
      var response;
      //alert(event.target.responseText);
      try {
        response = JSON.parse(event.target.responseText);
        //console.log(event.target.responseText);
        if (response.result.code==='OK'){
          tThis.successCallback(response);
        } else {
          tThis.errorCallback(response);
        }
      } catch (e) {
        alert('Error processing JSON response.');
        console.error('Parsing error:', e);
      }
    });
    XHR.addEventListener("error", function(event) {
      alert('Something went wrong ¯\(º_o)/¯');
    });
    XHR.open("POST", form.action);
    XHR.send(FD);
  }
};


window.addEventListener("load",function(){
    var txtUpload = new TxtFileUpload();
    txtUpload.setFormListener(document.getElementById("theForm"));
  }
);