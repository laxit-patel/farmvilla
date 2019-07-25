module.exports = function (grunt) {
	grunt.initConfig(
		{
			version: {
				project: {
					src: [
						'package.json'
					]
				},
				composer: {
					src: [
						'composer.json'
					]
				},
				load_php: {
					options: {
						prefix: '\\.*\\VERSION\.*\\s=\.*\\s\''
					},
					src: [
						'class-ti-white-label.php'
					]
				},
			},
		}
	);
	grunt.loadNpmTasks( 'grunt-version' );
};
