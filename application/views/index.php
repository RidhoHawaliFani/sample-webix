<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" href="//cdn.webix.com/edge/webix.css" type="text/css"> 
  <title>Password Management</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" type="text/css"> 
  <script src="//cdn.webix.com/edge/webix.js" type="text/javascript"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" type="text/javascript"></script>  
  <style>
    .red .webix_el_box{
      color: #10cc39;
    }
    .light_color {
      color : #56acdb;

    }
    .tremor {
      margin-left: 30px;
    }
    .webix_accordionitem{
      transition:width 0.5s;
    }
    .webix_accordionitem.vertical{
      transition:height 0.5s;
    }
  </style>
</head>
<body style="background-color: #fff;">


 <script type="text/javascript" charset="utf-8">



  var windows = webix.ui({
    view:"window",
    width : 500,
    head:{
      view:"toolbar", elements:[
      { label: "<span class='mdi mdi-history' style='font-size:20px;float:left; margin-right:15px;'></span>History Password Change",
      view: "label",},
      { view:"button", value:"<span class='mdi mdi-close'></span>", width:40, class :"webix_dark", click:function(){
        this.getTopParentView().hide();
      }}
      ]
    },
    position:"top",
    modal:true,
    move : true,


    body:{

      view:"datatable",
      id : "dataTableGetHistory",
      columns:[
        { id:"rank",  header:"No.",  width:50},
        { id:"title", header:"Tanggal Update",width:200},
      
      ],
      autoheight:true,
      autowidth:true,
      url:"<?php echo base_url(); ?>"+"Welcome/APIGetHistory"
        

    }
  });

  


  webix.ui({

    type : "space",
    margin : 30,
    padding :50,


    

    view : "form",
    id : "form_induk",


    elements : [{

      cols : [{

      },
      {


        view : "form",
        padding : 5,

        borderless:true, elements : [


        {
          template: "<br/><br/><span margin:auto><span style='font-size:60px; font-weight:bold;'>Change</span><br/><span style='font-size:60px; font-weight:bold;'>Your <font  class='light_color'>Password</font></span><br/><span style='font-size:60px; font-weight:bold;'>Regurarly</span><br/><img src='https://cdn.dribbble.com/users/510353/screenshots/6419683/forgotpassword_2x.jpg' style='width:70%; margin-top : -20px; transform : scale(0.8,0.8);'/></span>",
          borderless : true,
          height : 460,
          width: 450,
        },
        {

          id : "textD",
          label: "<span class='mdi mdi-information-outline' style='font-size:20px;float:left; margin-right:5px;'></span>",
          view: "label",

        },
        {
          view:"button", 
          
          
          label:"<span style='font-size:12px;'>Show history password change</span>", 
          width : 200,



          id:"btnSubmit2",
          click: function () {
            windows.show();
            $$("dataTableGetHistory").clearAll();
            $$("dataTableGetHistory").load("<?php echo base_url(); ?>"+"Welcome/APIGetHistory")
          }
          
        }
        ]
        


      },
      {

        rows:[

        { 
          view:"toolbar",
          css:"webix_dark",
          paddingX:27,
          paddingY:15,
          elements:[
          {view:"label", label:"Set new password"},
          {},
          {view:"icon", icon:"mdi mdi-help-circle-outline"}
          ]      
        },

        {view:"form",
        id : "form_1",
        elements: [
        {
          view: "text",
          id : "curPassID",
          name: "currentpasswd",
          type : "password",
          left: 690,
          top: 160,
          width: 400,
          placeholder: "Type current password",
          label: "Current Password",
          labelAlign: "left",
          labelPosition: "top",
          on : {
            onChange(newVal){

              jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>"+"Welcome/findData/"+newVal,
                dataType: 'json',
                  //mengirim data dengan type post
                  data: { stringSent: newVal},
                  //menerima result dari controller
                  success: function(res) {
                    if(res.hasil2 == 'true'){
                     webix.message("Correct password");
                     $$("newPassID").enable();

                   }
                   if(res.hasil2 == 'false'){
                    webix.message("Password didn't match<br/>Try Again please...");
                    $$("newPassID").disable();

                  }
                }


              });
              

              

              // webix.message("Value changed from "+newVal);
            }
          }
        },
        {
          view: "text",
          id : "newPassID",
          name: "newpasswd",
          type : "password",
          left: 690,
          top: 160,
          width: 400,
          placeholder: "Type new password",
          label: "New Password",
          labelAlign: "left",
          labelPosition: "top",
          disabled : "true",
          on : {
            onChange(newVal){
              if (newVal.length >  9) {
                $$("textA").config.label = "<span class='mdi mdi-check'></span> At least 8 characters";
                webix.html.addCss($$("textA").$view, "red");
                $$("textA").refresh();

                if (hasLowerCase(newVal) && hasNumber(newVal)) {
                  $$("textB").config.label = "<span class='mdi mdi-check'></span> Contains uppercase and numeric elements";
                  webix.html.addCss($$("textB").$view, "red");
                  $$("textB").refresh();
                  $$("confPassID").enable();
                }else {
                 $$("textB").config.label = "<span class='mdi mdi-minus'></span> Contains uppercase and numeric elements";
                 webix.html.removeCss($$("textB").$view, "red");
                 $$("textB").refresh();
                 $$("confPassID").disable();

                 $$("btnSubmit").disable();
               }
             } else {
              $$("textA").config.label = "<span class='mdi mdi-minus'></span> At least 8 characters";
              webix.html.removeCss($$("textA").$view, "red");
              $$("textA").refresh();
            }

              // webix.message("Value changed from "+newVal);
            }
          }
        },
        {
          view: "text",
          id : "confPassID",
          name: "confirmnewpasswd",
          type : "password",
          left: 690,
          top: 160,
          width: 400,
          placeholder: "Type new password again",
          label: "Re-type new password",
          labelAlign: "left",
          labelPosition: "top",
          disabled : "true",
          on : {
            onChange(newVal){
              if (newVal == $$("newPassID").getValue()) {
                $$("textC").config.label = "<span class='mdi mdi-check'></span> Password confirmed correctly";
                webix.html.addCss($$("textC").$view, "red");
                $$("textC").refresh();
                $$("btnSubmit").enable();

              }else {
                $$("textC").config.label = "<span class='mdi mdi-minus'></span> Password confirmed correctly";
                webix.html.removeCss($$("textC").$view, "red");
                $$("textC").refresh();
                $$("btnSubmit").disable();
              }
            }
          }

        }
        ]},
        {view:"form", elements: [
        {
          id : "textHeader",
          label: "Password must have : ",
          view: "label",
          left: 500,
          top: 170,
          width: 400
        },
        {
          id : "textA",
          label: "<span class='mdi mdi-minus'></span> At least 8 characters",
          view: "label",
          left: 500,
          top: 170,
          width: 400
        },
        {
          id : "textB",
          label: "<span class='mdi mdi-minus'></span> Contains uppercase and numeric elements",
          view: "label",
          left: 500,
          top: 170,
          width: 400,
          css: "icon_btn"
        },
        {
          id : "textC",
          label: "<span class='mdi mdi-minus'></span> Password confirmed correctly",
          view: "label",
          left: 500,
          top: 170,
          width: 400
        }


        ]},

        {view:"form", elements: [
        { view:"button", 
        css: "webix_primary", 
        label:"Save", 
        autowidth:false, 
        disabled:true, 
        id:"btnSubmit",
        on : {
          onItemClick(){



            var x = $$("newPassID").getValue();

            jQuery.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>"+"Welcome/updateThisData/"+x,
              dataType: 'json',
                  //mengirim data dengan type post
                  data: { stringSent: x},
                  //menerima result dari controller
                  success: function(res) {
                    if(res.hasil2 == 'true'){
                     webix.message("Data saved!");
                     $$("newPassID").disable();
                     $$("confPassID").disable();
                     $$("btnSubmit").disable();

                     $$("textC").config.label = "<span class='mdi mdi-minus'></span> Password confirmed correctly";
                     webix.html.removeCss($$("textC").$view, "red");
                     $$("textC").refresh();

                     $$("textB").config.label = "<span class='mdi mdi-minus'></span> Contains uppercase and numeric elements";
                     webix.html.removeCss($$("textB").$view, "red");
                     $$("textB").refresh();

                     $$("textA").config.label = "<span class='mdi mdi-minus'></span> At least 8 characters";
                     webix.html.removeCss($$("textA").$view, "red");
                     $$("textA").refresh();

                     //reload information last update
                     jQuery.ajax({
                      type: "POST",
                      url: "<?php echo base_url(); ?>"+"Welcome/getHistory",
                      dataType: 'json',
                          //mengirim data dengan type post
                          data: { stringSent: ''},
                          //menerima result dari controller
                          success: function(res) {
                            if(res.hasil2 == 'true'){
                              $$("textD").config.label = "<span style='display:block; margin:auto; text-align:center; font-size:14px;'><span class='mdi mdi-information-outline' style='font-size:20px;float:left; margin-right:5px;'><span style='font-size:14px;margin-left:10px; float:right'>Last update "+res.jarakhari+" ("+res.date+")</span></span></span>";
                              $$("textD").refresh();

                            }
                            if(res.hasil2 == 'false'){
                              $$("textD").config.label = "<span class='mdi mdi-information-outline' style='font-size:20px;float:left; margin-right:5px;'>Password never changed.</span>";
                              $$("textD").refresh();

                            }
                          }


                        });

                   }
                   if(res.hasil2 == 'false'){
                    webix.message("Something wrong when saving data...");


                  }
                }


              });

            $$('form_1').clear(); 



              // webix.message("Value changed from "+newVal);
            }
          }
        }
        ]},
        {
          label: "Developed with <span class='mdi mdi-heart' style='color:pink'></span> by Ridho Hawali Fani",
          view: "label",
          align : "center",

        }



        
        ]
      },{} ]} 
      ]}
      );

function hasLowerCase(str) {
  return (/[A-Z]/.test(str));
}
function hasNumber(myString) {
  return /\d/.test(myString);
}

 

$$("form_induk").load(function(){
  jQuery.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>"+"Welcome/getHistory",
    dataType: 'json',
                  //mengirim data dengan type post
                  data: { stringSent: ''},
                  //menerima result dari controller
                  success: function(res) {
                    if(res.hasil2 == 'true'){
                      $$("textD").config.label = "<span style='display:block; margin:auto; text-align:center; font-size:14px;'><span class='mdi mdi-information-outline' style='font-size:20px;float:left; margin-right:5px;'><span style='font-size:14px;margin-left:10px; float:right'>Last update "+res.jarakhari+" ("+res.date+")</span></span></span>";
                      $$("textD").refresh();
                      $$("btnSubmit2").enable();

                    }
                    if(res.hasil2 == 'false'){
                      $$("btnSubmit2").disable();
                      $$("textD").config.label = "<span class='mdi mdi-information-outline' style='font-size:20px;float:left; margin-right:5px;'>Password never changed.</span>";
                      $$("textD").refresh();

                    }
                  }


                });
});
</script>
</body>
</html>