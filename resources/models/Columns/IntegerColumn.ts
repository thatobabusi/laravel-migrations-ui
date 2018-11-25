import Column from '../Column';

export default class IntegerColumn extends Column
{
    public unsigned: boolean;
    public nullable: boolean;
    public size: IntegerColumnSize;
    public defaultValue: number | null;
}

export enum IntegerColumnSize
{
    Tiny,
    Small,
    Medium,
    Normal,
    Big,
}
