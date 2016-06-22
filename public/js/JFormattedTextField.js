/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


txtCliNasc = new javax.swing.JFormattedTextField();

try {

MaskFormatter mascara = new MaskFormatter("##/##/####"); 
mascara.setPlaceholderCharacter('_');

txtCliNasc.setFormatterFactory(new javax.swing.text.DefaultFormatterFactory(mascara));

} catch (java.text.ParseException ex) {
ex.printStackTrace();
}