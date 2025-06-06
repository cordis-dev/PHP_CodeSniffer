<!-- Tests with short open tag. -->

<input name="<? ; something_else(); ?>" />
<input name="<? something_else(); ; ?>" />

/*
 * Test empty statement: no code between PHP open and close tag.
 */
<input name="<? something_else() ?>" /> <!-- OK. -->
<input name="<? something_else(); ?>" /> <!-- OK. -->
<input name="<? /* comment */ ?>" /> <!-- OK. -->

<input name="<? ?>" /> <!-- Bad. -->

<input name="<?


?>" /> <!-- Bad. -->

<!--
/*
 * Test detecting & fixing a combination of the two checks.
 */
-->
<? ; ?>

<input name="<? ; ?>" /> <!-- Bad. -->
