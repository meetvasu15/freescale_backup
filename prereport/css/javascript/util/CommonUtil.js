/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function replaceAll(find, replace, str) {
    return str.replace(new RegExp(find, 'g'), replace);
}
 
function isBlankString(val){
    val =String(val).trim();
    if (val == undefined || 
            val == "" || 
            val.length <= 0){
        return true;
    }
    return false;
}

if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}