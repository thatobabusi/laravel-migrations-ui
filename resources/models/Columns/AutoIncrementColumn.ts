import Column from '../Column';
import { IntegerColumnSize } from './IntegerColumn';

export default class AutoIncrementColumn extends Column
{
    public size: IntegerColumnSize;
    public startValue: number;
}
