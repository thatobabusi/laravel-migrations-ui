import ForeignKey from './ForeignKey';
import Index from './Index';
import Table from './Table';

export default abstract class Column
{
    public table: Table | null = null;
    public name: string = '';
    public comment: string = '';
    public generatedType: GeneratedType | null;
    public generatedExpression: string | null;

    public foreignKey(): ForeignKey | null {
        throw new Error('Not Implemented');
    }

    public index(): Index | null {
        throw new Error('Not Implemented');
    }

    public uniqueIndex(): Index | null {
        throw new Error('Not Implemented');
    }
}

export enum GeneratedType
{
    Virtual,
    Stored,
}
