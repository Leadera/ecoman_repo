/* i18n function */
Ext.namespace("Ostim.i18n");

function __(string) {
    // Global Dictionary
    var dict = Ostim.i18n.dict;

    // If dictionary exists and has entry return value
    if (typeof(dict) != 'undefined' && dict[string]) {
        return dict[string];
    }
    // Dictionary does not exist or entry undefined: return key string
    return string;
}