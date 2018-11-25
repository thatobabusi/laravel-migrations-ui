import Column from './Column';
import Database from './Database';
import ForeignKey from './ForeignKey';
import Index from './Index';

export default class Table
{
    public database: Database | null = null;
    public name: string = '';
    public comment: string = '';

    public columns(): Column[] {
        throw new Error('Not Implemented');
    }

    public foreignKeys(): ForeignKey[] {
        throw new Error('Not Implemented');
    }

    public indexes(): Index[] {
        throw new Error('Not Implemented');
    }
}
