$(document).ready((function(){$("#name").on("keyup",(function(){var e=$(this).val();e=function(e){return e.replace(/\s+/g,"-").replace(/[aeiou]/gi,"").toLowerCase()}(e),$("#code").val(e)}))}));