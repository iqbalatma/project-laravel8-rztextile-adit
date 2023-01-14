$(document).ready(function(){
  function getGeneratedRollCode(name) {
    name = name.replace(/\s+/g, '-').replace(/[aeiou]/gi,"").toLowerCase();
    return name;
  }

  $("#name").on("keyup", function(){
    let name = $(this).val();
    name = getGeneratedRollCode(name);
    $("#code").val(name);
  });
});