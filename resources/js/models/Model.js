/**
 * @abstract
 */
export default class Model
{
    _fields = [
        // Override in child classes
    ];

    // Note: Can't make this part of the constructor because the child class
    // doesn't set this._fields until after the constructor runs
    init(data = {}) {
        for (let field of this._fields) {
            this[field] = null;
        }

        this.fill(data);
    }

    fill(data) {
        for (let field of this._fields) {
            if (field in data) {
                this[field] = data[field];
            }
        }
    }
}
