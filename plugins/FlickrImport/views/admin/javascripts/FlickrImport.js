
/**
 *This function parses the provided flickr url to distinguish between
 *photosets, galleries, and photostreams. It grabs the identifying
 *string for the appropriate collection type. When finished, it calls
 *getPhotoIDs.
 */
function parseURL(url,userID){
  apikey = jQuery("input#apikey").val();
  if(userID) {
    apikey = jQuery("input#apikey").val();
    url = resolveShortUrl(url);

    var setSplit = url.split("sets");
    if(setSplit.length == 1)
      setSplit = url.split("albums");
    var galSplit = url.split("galler");

    //gallery
    if(galSplit.length >1 && setSplit.length==1)
    {
      var glpurl = "https://api.flickr.com/services/rest/?api_key="+apikey+"&format=json&jsoncallback=?&method=flickr.urls.lookupGallery&url="+encodeURIComponent(url);
      jQuery.getJSON( glpurl , {format: "json"})
        .done(function( msg ) {
	  getPhotoIDs(msg.gallery.id,userID,"gallery");
        });

      //photoset
    } else if (galSplit.length ==1 && setSplit.length > 1) {
      var setID = setSplit[setSplit.length-1];
      setID = setID.replace(/\//g,"");
      getPhotoIDs(setID,userID,"photoset");

      //photostream
    } else if (galSplit.length==1 && setSplit.length ==1) {
      getPhotoIDs(false,userID,"photostream");
    }

  } else {

    var glpurl = "https://api.flickr.com/services/rest/?api_key="+apikey+"&format=json&jsoncallback=?&method=flickr.urls.lookupUser&url="+encodeURIComponent(url);
    jQuery.getJSON( glpurl , {format: "json"})
      .done(function( msg ) {
        parseURL(url,msg.user.id);
      });
  }
}

function getUserID(url){
}

/*
 *This function returns an array of photoIDs contained within
 *the given Flickr collection. It takes one parameter which is
 *an array containing the identifying string for the collection
 *and the collection type.
 *When finished, this function calls addPhoto, which adds the
 *photo to the preview div.
 */
function getPhotoIDs(setID,userID,type){
  var apikey = jQuery('input#apikey').val();
  var apiBase = "https://api.flickr.com/services/rest/?api_key="+apikey+"&format=json&jsoncallback=?&method=flickr.";

  if(type == "gallery")
    url = apiBase+"galleries.getPhotos&gallery_id="+setID;
  else if (type == "photoset")
    url = apiBase+"photosets.getPhotos&photoset_id="+setID;
  else if (type == "photostream")
    url = apiBase+"people.getPublicPhotos";
  
  url += "&user_id="+userID;
  jQuery.getJSON( url , {format: "json"})
    .done(function( msg ) {
      if(type=="gallery")
	addPhoto(msg.photos.photo,0);
      else if (type=="photoset")
	addPhoto(msg.photoset.photo,0);    
      else if (type=="photostream")
	addPhoto(msg.photos.photo,0);
    });    
}

/*
 *This function retrieves a thumbnail and title for the given
 *Flickr photoID and adds them with a checkbox to the photo
 *preview div
 */
function addPhoto(photos,i){

  var urlBase = "https://api.flickr.com/services/rest/?api_key=a664b4fdddb9e009f43e8a6012b1a392&format=json&jsoncallback=?&method=flickr.photos.getSizes&photo_id=";

  var htmlBegin = '<div class="previewPicDiv"><input type="checkbox" name="flickr-selected['+photos[i].id+']" class="previewCheck" /><img class="previewPic" src="';
  var htmlMiddle = '" ><label class="previewLabel">';
  var htmlEnd = "</previewLabel></div>";

  jQuery.getJSON( urlBase+photos[i].id , {format: "json"})
    .done(function( msg ) {
      jQuery('#previewThumbs').append(htmlBegin+msg.sizes.size[2].source+htmlMiddle+photos[i].title+htmlEnd);
      addPhoto(photos,++i);
    }); 

}

/*
 *This function returns a boolean value indicating whether the 
 *text in the Flickr url input constitute a valid Flickr URL
 */
function validFlickrUrl(url){
  var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
  if(!regexp.test(url))
    return false;
  if(url.indexOf("flickr.com")<0 && url.indexOf("flic.kr")<0)
    return false;
  return true;
}


/*
 *This function resolves short flickr URLs so that preview images can be 
 *generated
 */
function resolveShortUrl(url){
  if(url.indexOf("flic.kr")<0)
    return url;
}


//Interface functions
jQuery( document ).ready(function(){
  
  //If the user decides to select individual images to import from a collection,
  //parse the URL (which will initiate adding the thumbnail images to the 
  // preview div).
  jQuery('#flickrselecting-true').click(function(e){
    var url = jQuery("#flickrurl").val();
    if(!validFlickrUrl(url)){
      alert('Invalid Flickr Url');
      return;
    }
    jQuery('#previewThumbs').html('');
    jQuery('#previewThumbs').show();
    jQuery('#previewThumbs').append('<input type="hidden" name="flickr-selecting" value="true"/><div id="previewSelectButtons"><button id="previewSelectAll">Select All</button><button id="previewDeselectAll">Deselect All</button></div>');

    jQuery('#previewSelectAll').click(function(event){
      event.preventDefault();
      jQuery('.previewCheck').each(function() {
	jQuery(this).prop('checked','checked');
      });
    });

    jQuery('#previewDeselectAll').click(function(event){
      event.preventDefault();
      jQuery('.previewCheck').each(function() {
	jQuery(this).prop('checked',false);
      });
    });

    parseURL(url);
  });

  jQuery('#flickrselecting-false').click(function(e){
    jQuery('#previewThumbs').hide(400);
  });

  //Hide the options for selecting which images to import if you 
  //click the import single button
  jQuery('#flickrnumber-single').click(function(){
    jQuery('#flickrselectingfield').hide(400);
    jQuery('#previewThumbs').hide(400);
  });

  //Show the options for selecting which images to import if you
  //click the import multiple button
  jQuery('#flickrnumber-multiple').click(function(){
    jQuery('#flickrselectingfield').show(400);
  });

  //if you change the Flickr url while you are supposed to be selecting
  //which images to import, update the preview images.
  jQuery('#flickrurl').change(function(){
    var number = jQuery('input[name="flickrnumber"]:checked').val();
    var selecting = jQuery('input[name="flickrselecting"]:checked').val();
    var url = jQuery("#flickrurl").val();
    if(number == "multiple" && selecting == "true" && validFlickrUrl(url))
      parseURL(url);
  });

  //if the "import single" option is checked when the page loads 
  //(only happens when the form repopulates after a submission)
  //hide the item selection options.
  var single = jQuery('input[name="flickrnumber"]:checked').val();
  if(single=='single')
    jQuery('#flickrselectingfield').hide();

  //if the "select items to import" option is checked when the page loads 
  //(only happens when the form repopulates after a submission)
  //go ahead and check the other one.
  var radios = jQuery('input[name="flickrselecting"]:checked');
  if(radios.val()=='true')
    jQuery('#flickrselecting-false').prop("checked",true);

  jQuery('#flickrnumber-single').click();
});

