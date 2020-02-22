import Model from './Model';

/**
 * @property {string} name
 * @property {string} date
 * @property {string} title
 * @property {Number|null} batch
 * @property {string} relPath
 * @property {string} source
 * @property {boolean} loading
 * @property {boolean} running
 */
export default class Migration extends Model
{
    _fields = [
        'name',
        'date',
        'title',
        'batch',
        'relPath',
        'source',

        'loading',
        'running',
    ];

    constructor(name) {
        super();

        this.init({
            name,
            loading: false,
            running: false,
        });
    }

    get isApplied() {
        return this.batch !== null;
    }

    get isMissing() {
        return this.relPath === null;
    }
}
