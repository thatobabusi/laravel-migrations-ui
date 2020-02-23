import Model from './Model';

export default class Migration extends Model
{
    date = null;
    title = null;
    batch = null;
    relPath = null;
    source = null;
    loading = false;
    running = false;

    constructor(name) {
        super();

        this.name = name;
    }

    get isApplied() {
        return this.batch !== null;
    }

    get isMissing() {
        return this.relPath === null;
    }
}
