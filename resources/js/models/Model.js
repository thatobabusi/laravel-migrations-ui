/**
 * @abstract
 */
export default class Model
{
    fill(data) {
        for (let [key, value] of Object.entries(data)) {
            if (this.hasOwnProperty(key)) {
                this[key] = value;
            } else {
                console.warn(this.constructor.name, 'fill(): ignoring unknown key', key, 'in', data, 'when updating', this);
            }
        }
    }
}
