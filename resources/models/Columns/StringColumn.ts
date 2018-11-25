import Column from '../Column';

export default class StringColumn extends Column
{
    public nullable: boolean;
    public size: number | null;
    public defaultValue: string | null;
    public charset: string | null;
    public collation: string | null;
}
