import Database from './Database';

export default class Connection
{
    public readonly name: string;

    constructor(name: string) {
        this.name = name;
    }

    public databases(): Database[] {
        throw new Error('Not Implemented');
    }
}
