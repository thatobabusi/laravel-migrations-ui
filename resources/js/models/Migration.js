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
