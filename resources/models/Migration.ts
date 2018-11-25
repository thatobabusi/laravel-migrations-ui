export default class Migration
{
    public date: Date;
    public name: string;
    public fileExists: boolean;
    public batchNumber: number | null;
    public code: string | null;
}
