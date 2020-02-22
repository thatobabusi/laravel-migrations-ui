const fields = [
    'name',
    'date',
    'title',
    'batch',
    'isApplied',
    'isMissing',
    'relPath',
    'source',

    'loading',
    'running',
];

/**
 * @property {string} name
 * @property {string} date
 * @property {string} title
 * @property {Number|null} batch
 * @property {boolean} isApplied
 * @property {boolean} isMissing
 * @property {string} relPath
 * @property {string} source
 * @property {boolean} loading
 * @property {boolean} running
 */
export default class Migration {
    constructor(name) {
        for (let field of fields) {
            this[field] = null;
        }

        this.name = name;
        this.loading = false;
        this.running = false;
    }

    update(data) {
        for (let field of fields) {
            if (field in data) {
                this[field] = data[field];
            }
        }
    }
}
