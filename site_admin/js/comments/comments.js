    function show_comments(page_){

           if (!window.hcb_user) {
              hcb_user = {};
            }(function() {
              var s = document.createElement("script"),
                l = hcb_user.PAGE || ("" + window.location).replace(/'/g, "%27"),
                h = "";
             
               s.setAttribute("type", "text/javascript");
              
              var kn = "https://www.htmlcommentbox.com/jread?page=" + page_.replace("+", "%2B") + "&mod=" + COMMENT_API + "&opts=16862&num=10&ts=1615119073229";
              
            //  console.log(kn);

              s.setAttribute("src", kn);

              if (typeof s != "undefined") document.getElementsByTagName("head")[0].appendChild(s);

            })();
    }
